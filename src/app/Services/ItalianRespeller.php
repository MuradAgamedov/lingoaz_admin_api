<?php

namespace App\Services;

/**
 * Rule-based respelling of Italian words in the Azerbaijani-style notation used in the dictionary
 * (c = j as in "John", ç = ch, ş = sh, q = hard g, ly = gli, ny = gn, ts = z ...).
 * Italian spelling is close to phonetic, so a handful of ordered rules is enough for a draft.
 * Stress and open/closed vowels are not modelled, so the result is a suggestion to be reviewed.
 */
class ItalianRespeller
{
    private const V = 'aeiou';

    public static function respell(string $text): string
    {
        $text = mb_strtolower(trim($text));
        $text = preg_replace('/[!?.…"“”«»()]/u', '', $text);

        return trim(preg_replace_callback('/\p{L}+/u', fn (array $m) => self::word($m[0]), $text));
    }

    private static function word(string $w): string
    {
        $w = strtr($w, [
            'à' => 'a', 'á' => 'a', 'è' => 'e', 'é' => 'e', 'ì' => 'i', 'í' => 'i',
            'ò' => 'o', 'ó' => 'o', 'ù' => 'u', 'ú' => 'u', 'ï' => 'i', 'ü' => 'u',
        ]);

        $V = self::V;

        // Rule outputs are UPPERCASE so that later rules (which look for lowercase input letters)
        // cannot touch them; everything is lowercased at the end.
        $rules = [
            // foreign letters
            '/j/u' => 'Y',
            '/w/u' => 'V',
            '/x/u' => 'KS',
            '/y/u' => 'I',
            // gli / gn
            "/gli(?=[{$V}])/u" => 'LY',
            '/gli$/u' => 'LYI',
            '/gn/u' => 'NY',
            // sc, sch
            "/sci(?=[{$V}])/u" => 'Ş',
            '/sc(?=[ei])/u' => 'Ş',
            '/sch/u' => 'SK',
            // ch / gh
            "/chi(?=[{$V}])/u" => 'KY',
            '/ch(?=[ei])/u' => 'K',
            "/ghi(?=[{$V}])/u" => 'QY',
            '/gh(?=[ei])/u' => 'Q',
            // soft c / g (an i before another vowel is only a spelling device)
            "/cci(?=[{$V}])/u" => 'ÇÇ',
            '/cc(?=[ei])/u' => 'ÇÇ',
            "/ci(?=[{$V}])/u" => 'Ç',
            '/c(?=[ei])/u' => 'Ç',
            "/ggi(?=[{$V}])/u" => 'CC',
            '/gg(?=[ei])/u' => 'CC',
            "/gi(?=[{$V}])/u" => 'C',
            '/g(?=[ei])/u' => 'C',
            // hard c / g
            '/qu/u' => 'KU',
            '/c/u' => 'K',
            '/g/u' => 'Q',
            // z
            '/zz/u' => 'TTS',
            '/z/u' => 'TS',
            // s between vowels or before a voiced consonant is voiced
            "/(?<=[{$V}])s(?=[{$V}])/u" => 'Z',
            '/s(?=[bdglmnrv])/u' => 'Z',
            // silent h
            '/h/u' => '',
        ];

        return mb_strtolower(preg_replace(array_keys($rules), array_values($rules), $w));
    }
}
