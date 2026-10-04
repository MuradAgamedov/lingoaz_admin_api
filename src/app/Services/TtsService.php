<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TtsService
{
    public const MAX_LENGTH = 160;

    public const DEFAULT_VOICE = 'sara';

    /**
     * Available voices: key => [config key of the service URL, extra query parameters].
     */
    public const VOICES = [
        'piper' => ['piper_url', []],
        'sara' => ['kokoro_url', ['voice' => 'if_sara']],
        'nicola' => ['kokoro_url', ['voice' => 'im_nicola']],
    ];

    public function normalize(string $text): string
    {
        return trim(preg_replace('/\s+/u', ' ', $text));
    }

    public function voice(?string $voice): string
    {
        return array_key_exists((string) $voice, self::VOICES) ? $voice : self::DEFAULT_VOICE;
    }

    public function relativePath(string $text, ?string $voice = null): string
    {
        return 'tts/'.$this->voice($voice).'/'.md5(mb_strtolower($this->normalize($text))).'.wav';
    }

    /**
     * Return the absolute path of the cached audio file, synthesizing it if needed.
     * Returns null when the text is invalid or the speech service is unavailable.
     */
    public function ensure(string $text, ?string $voice = null): ?string
    {
        $text = $this->normalize($text);
        $voice = $this->voice($voice);

        if ($text === '' || mb_strlen($text) > self::MAX_LENGTH) {
            return null;
        }

        $disk = Storage::disk('public');
        $path = $this->relativePath($text, $voice);

        if (! $disk->exists($path)) {
            [$urlKey, $extra] = self::VOICES[$voice];

            try {
                $response = Http::timeout(60)->get(
                    rtrim(config('services.tts.'.$urlKey), '/').'/',
                    ['text' => $text, ...$extra]
                );
            } catch (\Throwable) {
                return null;
            }

            if (! $response->successful() || $response->body() === '') {
                return null;
            }

            $disk->put($path, $response->body());
        }

        return $disk->path($path);
    }
}
