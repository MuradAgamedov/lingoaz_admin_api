import json
import re
import threading
from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer
from urllib.parse import parse_qs, urlparse

import ctranslate2
import sentencepiece as spm

MODEL = "/model"
SRC, TGT = "ita_Latn", "azj_Latn"

translator = ctranslate2.Translator(MODEL, device="cpu", inter_threads=1, intra_threads=2, compute_type="int8")
sp = spm.SentencePieceProcessor()
sp.load(MODEL + "/sentencepiece.bpe.model")
lock = threading.Lock()  # one translation at a time keeps CPU/RAM predictable

PREDICATE_SUFFIX = re.compile(r"(dir|dır|dur|dür)$")


def clean(candidate: str, source: str) -> str:
    text = candidate.strip().strip(".!?;:,").strip()
    # NLLB capitalizes single words and sometimes adds a predicate suffix ("sadiqdir").
    if source and source[0].islower() and " " not in source:
        text = text[:1].lower() + text[1:]
    # keep a question / exclamation mark when the Italian text has one
    if text and source.rstrip().endswith(("?", "!")):
        text += source.rstrip()[-1]
    return text


def translate(text: str, n: int = 3):
    tokens = [SRC] + sp.encode(text, out_type=str) + ["</s>"]
    with lock:
        result = translator.translate_batch(
            [tokens], target_prefix=[[TGT]], beam_size=5, num_hypotheses=n, max_decoding_length=80
        )[0]

    out = []
    single_word = " " not in text.strip()
    for hyp in result.hypotheses:
        candidate = clean(sp.decode(hyp[1:]), text)
        variants = [candidate]
        if single_word and PREDICATE_SUFFIX.search(candidate) and len(candidate) > 5:
            variants.append(PREDICATE_SUFFIX.sub("", candidate))
        for v in variants:
            if v and v.lower() not in [o.lower() for o in out]:
                out.append(v)
    return out[: n + 1]


ARTICLE_PREFIX = re.compile(r"^(bir|bu|o)\s+", re.IGNORECASE)


def suggestions(text: str):
    """Single words are translated twice (bare and with an Italian article, which gives the model
    context) and the lists are merged; phrases are translated as they are."""
    text = text.strip()
    if " " in text:
        return translate(text)

    bare = translate(text)
    article = ("una " if text.endswith("a") else "un ") + text
    with_article = []
    for candidate in translate(article):
        candidate = ARTICLE_PREFIX.sub("", candidate.strip())
        if text[:1].islower():
            candidate = candidate[:1].lower() + candidate[1:]
        with_article.append(candidate)

    merged = []
    for candidate in with_article[:2] + bare + with_article[2:]:
        if candidate and candidate.lower() not in [m.lower() for m in merged]:
            merged.append(candidate)
    return merged[:5]


class Handler(BaseHTTPRequestHandler):
    def do_GET(self):
        url = urlparse(self.path)
        if url.path == "/health":
            self.send_response(200)
            self.end_headers()
            self.wfile.write(b"ok")
            return

        text = (parse_qs(url.query).get("text") or [""])[0].strip()
        if url.path != "/translate" or not text or len(text) > 200:
            self.send_response(400)
            self.end_headers()
            return

        try:
            body = json.dumps({"translations": suggestions(text)}, ensure_ascii=False).encode()
        except Exception as exc:  # noqa: BLE001
            self.send_response(500)
            self.end_headers()
            self.wfile.write(str(exc).encode())
            return

        self.send_response(200)
        self.send_header("Content-Type", "application/json; charset=utf-8")
        self.send_header("Content-Length", str(len(body)))
        self.end_headers()
        self.wfile.write(body)

    def log_message(self, *args):
        pass


if __name__ == "__main__":
    ThreadingHTTPServer(("0.0.0.0", 8000), Handler).serve_forever()
