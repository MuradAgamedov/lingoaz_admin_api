<?php

namespace App\Livewire\Game;

use App\Models\Word;
use App\Services\QuestionPool;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Play extends Component
{
    public string $mode = 'original_to_translation';

    public string $group = 'all';

    public string $customIds = '';

    public array $questionIds = [];

    public int $currentIndex = 0;

    public int $score = 0;

    public array $wrongWordIds = [];

    public array $results = [];

    public array $options = [];

    public ?int $currentWordId = null;

    public bool $answered = false;

    public ?string $feedback = null;

    public ?string $feedbackCorrectLabel = null;

    public string $typedAnswer = '';

    public bool $revealed = false;

    public bool $currentStarred = false;

    public bool $finished = false;

    public function mount(): void
    {
        $this->mode = request()->query('mode', $this->mode);
        $this->group = request()->query('group', $this->group);
        $this->customIds = request()->query('ids', $this->customIds);

        $this->startRun($this->group, mistakesOnly: false);
    }

    public function submitChoice(int $optionId): void
    {
        if ($this->answered) {
            return;
        }

        $this->registerAnswer($optionId === $this->currentWordId);
    }

    public function submitTyped(): void
    {
        if ($this->answered) {
            return;
        }

        $word = Word::find($this->currentWordId);

        $normalize = fn (string $value): string => strtr(trim(mb_strtolower($value)), [
            'à' => 'a', 'á' => 'a', 'è' => 'e', 'é' => 'e', 'ì' => 'i', 'í' => 'i',
            'ò' => 'o', 'ó' => 'o', 'ù' => 'u', 'ú' => 'u', 'ü' => 'u',
        ]);

        $this->registerAnswer($normalize($this->typedAnswer) === $normalize($word->original));
    }

    public function reveal(): void
    {
        $this->revealed = true;
    }

    public function markKnown(bool $knew): void
    {
        if (! $this->revealed || $this->currentWordId === null) {
            return;
        }

        if (! array_key_exists($this->currentIndex, $this->results)) {
            $this->track($knew);
            $this->results[$this->currentIndex] = $knew;

            if ($knew) {
                $this->score++;
            } else {
                $this->wrongWordIds[] = $this->currentWordId;
            }
        }

        $this->next();
    }

    private function track(bool $correct): void
    {
        Word::where('user_id', Auth::id())->find($this->currentWordId)?->recordAnswer($correct);
    }

    public function toggleStar(): void
    {
        $word = Word::where('user_id', Auth::id())->findOrFail($this->currentWordId);
        $word->update(['is_starred' => ! $word->is_starred]);
        $this->currentStarred = $word->is_starred;
    }

    public function next(): void
    {
        $this->currentIndex++;
        $this->loadQuestion();
    }

    public function previous(): void
    {
        if ($this->currentIndex <= 0) {
            return;
        }

        $this->currentIndex--;
        $this->loadQuestion();
    }

    public function restart(bool $mistakesOnly): void
    {
        if ($mistakesOnly) {
            $this->startRun($this->group, mistakesOnly: true, wordIds: $this->wrongWordIds);
        } else {
            $this->startRun($this->group, mistakesOnly: false);
        }
    }

    private function startRun(string $group, bool $mistakesOnly, array $wordIds = []): void
    {
        if ($mistakesOnly) {
            $ids = $wordIds;
        } elseif ($group === 'custom') {
            $requestedIds = array_filter(array_map('intval', explode(',', $this->customIds)));
            $ids = Word::where('user_id', Auth::id())->whereIn('id', $requestedIds)->pluck('id')->all();
        } else {
            $ids = (new QuestionPool)->scopedWords(Auth::id(), $group)->pluck('id')->all();
        }

        shuffle($ids);

        $this->questionIds = $ids;
        $this->currentIndex = 0;
        $this->score = 0;
        $this->wrongWordIds = [];
        $this->results = [];
        $this->finished = false;

        $this->loadQuestion();
    }

    private function loadQuestion(): void
    {
        $this->answered = false;
        $this->feedback = null;
        $this->feedbackCorrectLabel = null;
        $this->typedAnswer = '';
        $this->revealed = false;
        $this->options = [];

        if ($this->currentIndex >= count($this->questionIds)) {
            $this->finished = true;
            $this->currentWordId = null;

            return;
        }

        $this->currentWordId = $this->questionIds[$this->currentIndex];
        $this->currentStarred = (bool) Word::whereKey($this->currentWordId)->value('is_starred');

        if (in_array($this->mode, ['original_to_translation', 'translation_to_original'], true)) {
            $pool = Word::whereIn('id', $this->questionIds)->get();
            $correct = $pool->firstWhere('id', $this->currentWordId);
            $labelField = $this->mode === 'original_to_translation' ? 'translation' : 'original';

            $allWords = Word::where('user_id', Auth::id())->get();

            $this->options = (new QuestionPool)->buildOptions($pool, $correct, $labelField, 4, $allWords);
        }

        if (array_key_exists($this->currentIndex, $this->results) && $this->mode !== 'flash_original' && $this->mode !== 'flash_translation') {
            $this->restoreAnswer($this->results[$this->currentIndex]);
        }
    }

    private function restoreAnswer(bool $correct): void
    {
        $this->answered = true;
        $this->feedback = $correct ? 'correct' : 'incorrect';

        if (! $correct) {
            $word = Word::find($this->currentWordId);
            $this->feedbackCorrectLabel = $this->mode === 'original_to_translation' ? $word->translation : $word->original;
        }
    }

    private function registerAnswer(bool $correct): void
    {
        $this->answered = true;
        $this->feedback = $correct ? 'correct' : 'incorrect';
        $this->results[$this->currentIndex] = $correct;
        $this->track($correct);

        if ($correct) {
            $this->score++;
        } else {
            $this->wrongWordIds[] = $this->currentWordId;

            $word = Word::find($this->currentWordId);
            $this->feedbackCorrectLabel = $this->mode === 'original_to_translation' ? $word->translation : $word->original;
        }
    }

    public function render()
    {
        return view('livewire.game.play', [
            'currentWord' => $this->currentWordId ? Word::find($this->currentWordId) : null,
            'total' => count($this->questionIds),
        ]);
    }
}
