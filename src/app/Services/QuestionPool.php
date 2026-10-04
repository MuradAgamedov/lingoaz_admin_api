<?php

namespace App\Services;

use App\Models\Word;
use Illuminate\Support\Collection;

class QuestionPool
{
    public const DUE_LIMIT = 20;

    public function scopedWords(int $userId, string $group): Collection
    {
        if ($group === 'due') {
            return $this->dueWords($userId);
        }

        $query = Word::where('user_id', $userId);

        if ($group === 'starred') {
            $query->where('is_starred', true);
        } elseif ($group === 'hard') {
            $query->hard();
        } elseif ($group !== 'all') {
            $query->where('group_id', (int) $group);
        }

        return $query->get();
    }

    /**
     * Today's review: overdue words first, then new (never studied) words to fill the session.
     */
    public function dueWords(int $userId, int $limit = self::DUE_LIMIT): Collection
    {
        $due = Word::where('user_id', $userId)
            ->whereNotNull('next_review_at')
            ->where('next_review_at', '<=', now())
            ->orderBy('next_review_at')
            ->limit($limit)
            ->get();

        $missing = $limit - $due->count();

        if ($missing > 0) {
            $new = Word::where('user_id', $userId)
                ->whereNull('next_review_at')
                ->inRandomOrder()
                ->limit($missing)
                ->get();

            $due = $due->concat($new);
        }

        return $due->values();
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
