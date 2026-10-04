<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'group_id', 'original', 'pronunciation', 'translation', 'is_starred'])]
class Word extends Model
{
    /** Days until the next review for each box (Leitner system). */
    public const INTERVALS = [0, 1, 2, 4, 7, 15, 30];

    /** A word counts as learned once it reaches this box. */
    public const MASTERED_BOX = 4;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Words that were missed at least once and are not yet well known.
     */
    public function scopeHard(Builder $query): Builder
    {
        return $query->where('wrong_count', '>=', 1)->where('box', '<=', 2);
    }

    public function scopeMastered(Builder $query): Builder
    {
        return $query->where('box', '>=', self::MASTERED_BOX);
    }

    /**
     * Record an answer: move the word between boxes, schedule its next review and log it.
     */
    public function recordAnswer(bool $correct): void
    {
        $now = now();

        if ($correct) {
            $this->box = min($this->box + 1, count(self::INTERVALS) - 1);
            $this->correct_count++;
            $this->next_review_at = $now->copy()->addDays(self::INTERVALS[$this->box]);
        } else {
            $this->box = 0;
            $this->wrong_count++;
            $this->next_review_at = $now;
        }

        $this->last_reviewed_at = $now;
        $this->save();

        ReviewLog::create([
            'user_id' => $this->user_id,
            'word_id' => $this->id,
            'correct' => $correct,
        ]);
    }

    protected function casts(): array
    {
        return [
            'is_starred' => 'boolean',
            'next_review_at' => 'datetime',
            'last_reviewed_at' => 'datetime',
        ];
    }
}
