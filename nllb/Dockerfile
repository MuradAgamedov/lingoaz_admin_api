FROM python:3.11-slim

RUN pip install --no-cache-dir ctranslate2 sentencepiece

WORKDIR /app
COPY server.py /app/server.py

# The CTranslate2 NLLB-200 (600M, int8) model is mounted read-only at /model.
EXPOSE 8000
CMD ["python", "/app/server.py"]
