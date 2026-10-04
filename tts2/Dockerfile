FROM python:3.11-slim

RUN apt-get update && apt-get install -y --no-install-recommends curl ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN pip install --no-cache-dir kokoro-onnx numpy

WORKDIR /app
ARG REL=https://github.com/thewh1teagle/kokoro-onnx/releases/download/model-files-v1.0
RUN curl -fsSL -o kokoro.onnx "$REL/kokoro-v1.0.onnx" \
    && curl -fsSL -o voices.bin "$REL/voices-v1.0.bin"

COPY server.py /app/server.py
EXPOSE 8000
CMD ["python", "/app/server.py"]
