<?php

namespace App\Livewire\Dashboard;

use App\Models\Group;
use App\Models\ReviewLog;
use App\Models\Word;
use App\Services\QuestionPool;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    private const TZ = 'Asia/Baku';

    public function render()
    {
        $userId = Auth::id();

        $total = Word::where('user_id', $userId)->count();
        $mastered = Word::where('user_id', $userId)->mastered()->count();
        $fresh = Word::where('user_id', $userId)->whereNull('next_review_at')->count();
        $learning = $total - $mastered - $fresh;

        $logs = ReviewLog::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(60))
            ->get(['created_at', 'correct'])
            ->groupBy(fn ($log) => $log->created_at->copy()->timezone(self::TZ)->toDateString());

        $today = now(self::TZ)->toDateString();
        $todayLogs = $logs->get($today, collect());
        $todayTotal = $todayLogs->count();
        $todayCorrect = $todayLogs->where('correct', true)->count();

        // Consecutive days with at least one review (today may still be empty).
        $streak = 0;
        $cursor = now(self::TZ)->startOfDay();
        if (! $logs->has($cursor->toDateString())) {
            $cursor->subDay();
        }
        while ($logs->has($cursor->toDateString())) {
            $streak++;
            $cursor->subDay();
        }

        $week = collect(range(6, 0))->map(function (int $daysAgo) use ($logs) {
            $date = now(self::TZ)->subDays($daysAgo);

            return [
                'label' => [1 => 'B.e.', 2 => 'Ç.a.', 3 => 'Çər', 4 => 'C.a.', 5 => 'Cüm', 6 => 'Şən', 7 => 'Baz'][$date->dayOfWeekIso],
                'count' => $logs->get($date->toDateString(), collect())->count(),
                'today' => $daysAgo === 0,
            ];
        });

        $groups = Group::where('user_id', $userId)
            ->withCount(['words', 'words as mastered_count' => fn ($q) => $q->where('box', '>=', Word::MASTERED_BOX)])
            ->having('words_count', '>', 0)
            ->orderBy('id')
            ->get();

        return view('livewire.dashboard.index', [
            'total' => $total,
            'mastered' => $mastered,
            'learning' => $learning,
            'fresh' => $fresh,
            'dueCount' => (new QuestionPool)->dueWords($userId)->count(),
            'hardCount' => Word::where('user_id', $userId)->hard()->count(),
            'todayTotal' => $todayTotal,
            'todayAccuracy' => $todayTotal > 0 ? round($todayCorrect / $todayTotal * 100) : null,
            'streak' => $streak,
            'week' => $week,
            'weekMax' => max(1, $week->max('count')),
            'groups' => $groups,
        ]);
    }
}
