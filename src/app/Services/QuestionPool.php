<?php

namespace App\Services;

use App\Models\Word;
use Illuminate\Support\Collection;

class QuestionPool
{
    public function scopedWords(int $userId, string $group): Collection
    {
        $query = Word::where('user_id', $userId);

        if ($group === 'starred') {
            $query->where('is_starred', true);
        } elseif ($group !== 'all') {
            $query->where('group_id', (int) $group);
        }

        return $query->get();
    }

    /**
     * @return array<int, array{id: int, label: string}>
     */
    public function buildOptions(Collection $pool, Word $correct, string $labelField, int $distractorCount = 4, ?Collection $fallbackPool = null): array
    {
        $isCandidate = fn (Word $word) => $word->id !== $correct->id && $word->{$labelField} !== $correct->{$labelField};

        $distractors = $pool->filter($isCandidate)->shuffle()->take($distractorCount);

        if ($distractors->count() < $distractorCount && $fallbackPool) {
            $extra = $fallbackPool
                ->filter($isCandidate)
                ->reject(fn (Word $word) => $distractors->contains('id', $word->id))
                ->shuffle()
                ->take($distractorCount - $distractors->count());

            $distractors = $distractors->concat($extra);
        }

        return $distractors
            ->push($correct)
            ->shuffle()
            ->map(fn (Word $word) => ['id' => $word->id, 'label' => $word->{$labelField}])
            ->values()
            ->all();
    }
}
