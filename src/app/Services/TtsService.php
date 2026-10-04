<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TtsService
{
    public const MAX_LENGTH = 160;

    public function normalize(string $text): string
    {
        return trim(preg_replace('/\s+/u', ' ', $text));
    }

    public function relativePath(string $text): string
    {
        return 'tts/'.md5(mb_strtolower($this->normalize($text))).'.wav';
    }

    /**
     * Return the absolute path of the cached audio file, synthesizing it if needed.
     * Returns null when the text is invalid or the speech service is unavailable.
     */
    public function ensure(string $text): ?string
    {
        $text = $this->normalize($text);

        if ($text === '' || mb_strlen($text) > self::MAX_LENGTH) {
            return null;
        }

        $disk = Storage::disk('public');
        $path = $this->relativePath($text);

        if (! $disk->exists($path)) {
            try {
                $response = Http::timeout(30)->get(rtrim(config('services.tts.url'), '/').'/', ['text' => $text]);
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
