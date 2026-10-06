<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Suggests a translation (self-hosted NLLB-200 model) and a pronunciation (rule based) for an Italian word.
 * The result is only a draft that the user reviews before saving.
 */
class WordAssistant
{
    /**
     * @return array{translations: array<int, string>, pronunciation: ?string, error: ?string}
     */
    public function suggest(string $word): array
    {
        $word = trim(preg_replace('/\s+/u', ' ', $word));

        if ($word === '' || mb_strlen($word) > 120) {
            return ['translations' => [], 'pronunciation' => null, 'error' => null];
        }

        $translations = $this->translate($word);

        return [
            'translations' => $translations,
            'pronunciation' => ItalianRespeller::respell($word) ?: null,
            'error' => $translations === [] ? __('Tərcümə servisi cavab vermədi, özünüz yazın.') : null,
        ];
    }

    /**
     * @return array<int, string>
     */
    private function translate(string $word): array
    {
        $key = 'word-assistant:'.md5(mb_strtolower($word));

        if (is_array($cached = Cache::get($key)) && $cached !== []) {
            return $cached;
        }

        try {
            $response = Http::timeout(30)->get(rtrim(config('services.nllb.url'), '/').'/translate', ['text' => $word]);
        } catch (\Throwable) {
            return [];
        }

        $translations = $response->successful() ? array_values(array_filter((array) $response->json('translations'))) : [];

        if ($translations !== []) {
            Cache::put($key, $translations, now()->addDays(30));
        }

        return $translations;
    }
}
