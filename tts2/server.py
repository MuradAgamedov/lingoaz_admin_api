import io
import os
import threading
import wave
from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer
from urllib.parse import parse_qs, urlparse

import numpy as np
from kokoro_onnx import Kokoro

DEFAULT_VOICE = os.environ.get("TTS_VOICE", "if_sara")
DEFAULT_SPEED = float(os.environ.get("TTS_SPEED", "0.9"))

kokoro = Kokoro("/app/kokoro.onnx", "/app/voices.bin")
lock = threading.Lock()  # one synthesis at a time keeps CPU/RAM use predictable


def synth(text: str, voice: str, speed: float) -> bytes:
    with lock:
        samples, rate = kokoro.create(text, voice=voice, speed=speed, lang="it")

    pcm = (np.clip(samples, -1.0, 1.0) * 32767).astype(np.int16)
    buf = io.BytesIO()
    with wave.open(buf, "wb") as wav:
        wav.setnchannels(1)
        wav.setsampwidth(2)
        wav.setframerate(rate)
        wav.writeframes(pcm.tobytes())
    return buf.getvalue()


class Handler(BaseHTTPRequestHandler):
    def do_GET(self):
        url = urlparse(self.path)
        if url.path == "/health":
            self.send_response(200)
            self.end_headers()
            self.wfile.write(b"ok")
            return

        query = parse_qs(url.query)
        text = (query.get("text") or [""])[0].strip()
        voice = (query.get("voice") or [DEFAULT_VOICE])[0]
        if not text or len(text) > 160 or voice not in ("if_sara", "im_nicola"):
            self.send_response(400)
            self.end_headers()
            return

        try:
            audio = synth(text, voice, DEFAULT_SPEED)
        except Exception as exc:  # noqa: BLE001
            self.send_response(500)
            self.end_headers()
            self.wfile.write(str(exc).encode())
            return

        self.send_response(200)
        self.send_header("Content-Type", "audio/wav")
        self.send_header("Content-Length", str(len(audio)))
        self.end_headers()
        self.wfile.write(audio)

    def log_message(self, *args):
        pass


if __name__ == "__main__":
    ThreadingHTTPServer(("0.0.0.0", 8000), Handler).serve_forever()
