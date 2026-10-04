import io
import threading
import wave
from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer
from urllib.parse import parse_qs, urlparse

from piper import PiperVoice

voice = PiperVoice.load("/app/voice.onnx", config_path="/app/voice.onnx.json")
lock = threading.Lock()  # one synthesis at a time keeps CPU/RAM use predictable


def synth(text: str) -> bytes:
    buf = io.BytesIO()
    with lock:
        with wave.open(buf, "wb") as wav:
            if hasattr(voice, "synthesize_wav"):
                voice.synthesize_wav(text, wav)
            else:
                voice.synthesize(text, wav)
    return buf.getvalue()


class Handler(BaseHTTPRequestHandler):
    def do_GET(self):
        url = urlparse(self.path)
        if url.path == "/health":
            self.send_response(200)
            self.end_headers()
            self.wfile.write(b"ok")
            return

        text = (parse_qs(url.query).get("text") or [""])[0].strip()
        if not text or len(text) > 160:
            self.send_response(400)
            self.end_headers()
            return

        try:
            audio = synth(text)
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
