FROM python:3.11-slim

RUN apt-get update && apt-get install -y --no-install-recommends curl ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN pip install --no-cache-dir piper-tts

WORKDIR /app
ARG VOICE_BASE=https://huggingface.co/rhasspy/piper-voices/resolve/main/it/it_IT/paola/medium
RUN curl -fsSL -o voice.onnx "$VOICE_BASE/it_IT-paola-medium.onnx" \
    && curl -fsSL -o voice.onnx.json "$VOICE_BASE/it_IT-paola-medium.onnx.json"

COPY server.py /app/server.py
EXPOSE 8000
CMD ["python", "/app/server.py"]
