<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateWordsCommand extends Command
{
    protected $signature = 'words:translate';

    protected $description = 'Translate words from database';

    public function handle(): int
    {
        Dictionary::query()->update([
            'translation' => null,
            'translation_json' => null,
        ]);

        $this->info('All translations cleared.');

        $translator = new GoogleTranslate();
        $translator->setSource('en');
        $translator->setTarget('az');

        $words = Dictionary::query()->get();

        if ($words->isEmpty()) {
            $this->error('No words found for translation!');
            return Command::FAILURE;
        }

        foreach ($words as $index => $word) {
            try {
                $text = trim($word->word);

                if (!$text) {
                    continue;
                }

                $translation = $translator->translate($text);

                if (!$translation) {
                    $this->error("Translation empty: {$text}");
                    continue;
                }

                $word->update([
                    'translation' => $translation,
                    'translation_json' => [$translation],
                ]);

                $this->info("[{$index}] {$text} => {$translation}");

                sleep(1);

            } catch (\Throwable $e) {
                $this->error("Failed: {$word->word}");
                $this->error($e->getMessage());

                sleep(3);
            }
        }

        $this->info('Done! Translations completed.');

        return Command::SUCCESS;
    }
}