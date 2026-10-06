<?php

namespace App\Livewire\Dictionary;

use App\Models\Group;
use App\Models\Word;
use App\Services\TtsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public bool $showForm = false;

    public ?int $editingId = null;

    #[Validate('required|string|max:255')]
    public string $original = '';

    #[Validate('nullable|string|max:255')]
    public string $pronunciation = '';

    #[Validate('required|string|max:255')]
    public string $translation = '';

    public string $groupId = '';

    public bool $showNewGroupInput = false;

    public string $newGroupName = '';

    public string $filterGroupId = '';

    public bool $onlyStarred = false;

    public string $search = '';

    public bool $showBulk = false;

    public string $bulkText = '';

    public string $bulkGroupId = '';

    public ?string $bulkResult = null;

    public bool $audioGenerating = false;

    public ?string $audioMessage = null;

    private function audioKey(): string
    {
        return 'tts-generating-'.Auth::id();
    }

    public function mount(): void
    {
        $this->audioGenerating = (bool) Cache::get($this->audioKey());
    }

    /**
     * Generate the missing audio files in the background, after the response has been sent.
     */
    public function generateAudio(): void
    {
        $key = $this->audioKey();

        if (Cache::get($key)) {
            $this->audioGenerating = true;

            return;
        }

        $userId = Auth::id();

        if (count(app(TtsService::class)->wordsMissingAudio($userId)) === 0) {
            $this->audioMessage = __('Bütün sözlərin səsi hazırdır ✓');

            return;
        }

        Cache::put($key, true, now()->addMinutes(45));
        $this->audioGenerating = true;
        $this->audioMessage = null;

        app()->terminating(function () use ($key, $userId) {
            ignore_user_abort(true);
            set_time_limit(0);

            try {
                app(TtsService::class)->generateMissing($userId);
            } finally {
                Cache::forget($key);
            }
        });
    }

    public function refreshAudio(): void
    {
        if (Cache::get($this->audioKey())) {
            return;
        }

        $this->audioGenerating = false;
        $left = count(app(TtsService::class)->wordsMissingAudio(Auth::id()));
        $this->audioMessage = $left === 0
            ? __('Bütün səslər hazırdır ✓')
            : __(':n sözün səsi yaradıla bilmədi, yenidən cəhd edin', ['n' => $left]);
    }

    public function startCreate(): void
    {
        $this->reset('original', 'pronunciation', 'translation', 'groupId', 'editingId', 'showNewGroupInput', 'newGroupName', 'showBulk');
        $this->showForm = true;
    }

    public function openBulk(): void
    {
        $this->reset('bulkText', 'bulkGroupId', 'bulkResult');
        $this->showForm = false;
        $this->showBulk = true;
    }

    public function closeBulk(): void
    {
        $this->reset('showBulk', 'bulkText', 'bulkGroupId', 'bulkResult');
    }

    /**
     * Each line: "original | pronunciation | translation" or "original - translation".
     */
    public function saveBulk(): void
    {
        $this->validate(['bulkText' => 'required|string|max:50000'], [], ['bulkText' => __('Siyahı')]);

        $groupId = $this->bulkGroupId !== '' ? (int) $this->bulkGroupId : null;

        if ($groupId !== null) {
            Group::where('user_id', Auth::id())->findOrFail($groupId);
        }

        $added = 0;
        $skipped = 0;
        $invalid = 0;

        foreach (preg_split('/\R/u', $this->bulkText) as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            if (preg_match('/[|\t]/u', $line)) {
                $parts = array_map('trim', preg_split('/\s*[|\t]\s*/u', $line));
            } else {
                $parts = array_map('trim', preg_split('/\s+[—–-]\s+/u', $line, 2));
            }

            $parts = array_values(array_filter($parts, fn ($p) => $p !== ''));

            if (count($parts) === 2) {
                [$original, $translation] = $parts;
                $pronunciation = null;
            } elseif (count($parts) >= 3) {
                [$original, $pronunciation, $translation] = $parts;
            } else {
                $invalid++;

                continue;
            }

            if (mb_strlen($original) > 255 || mb_strlen($translation) > 255 || mb_strlen((string) $pronunciation) > 255) {
                $invalid++;

                continue;
            }

            $exists = Word::where('user_id', Auth::id())
                ->where('group_id', $groupId)
                ->whereRaw('BINARY original = ?', [$original])
                ->exists();

            if ($exists) {
                $skipped++;

                continue;
            }

            Word::create([
                'user_id' => Auth::id(),
                'group_id' => $groupId,
                'original' => $original,
                'pronunciation' => $pronunciation,
                'translation' => $translation,
            ]);
            $added++;
        }

        $this->bulkResult = __(':added söz əlavə olundu', ['added' => $added])
            .($skipped ? __(', :n təkrar atlandı', ['n' => $skipped]) : '')
            .($invalid ? __(', :n sətir oxunmadı', ['n' => $invalid]) : '');

        if ($added > 0) {
            $this->bulkText = '';
        }
    }

    public function startEdit(int $wordId): void
    {
        $word = Word::where('user_id', Auth::id())->findOrFail($wordId);

        $this->editingId = $word->id;
        $this->original = $word->original;
        $this->pronunciation = $word->pronunciation ?? '';
        $this->translation = $word->translation;
        $this->groupId = $word->group_id ? (string) $word->group_id : '';
        $this->showNewGroupInput = false;
        $this->newGroupName = '';
        $this->showForm = true;
    }

    public function cancel(): void
    {
        $this->reset('original', 'pronunciation', 'translation', 'groupId', 'editingId', 'showForm', 'showNewGroupInput', 'newGroupName');
    }

    public function createGroupInline(): void
    {
        $this->validateOnly('newGroupName', [
            'newGroupName' => 'required|string|max:255',
        ]);

        $group = Group::create([
            'user_id' => Auth::id(),
            'name' => $this->newGroupName,
        ]);

        $this->groupId = (string) $group->id;
        $this->newGroupName = '';
        $this->showNewGroupInput = false;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'original' => $this->original,
            'pronunciation' => $this->pronunciation !== '' ? $this->pronunciation : null,
            'translation' => $this->translation,
            'group_id' => $this->groupId !== '' ? (int) $this->groupId : null,
        ];

        if ($this->editingId) {
            $word = Word::where('user_id', Auth::id())->findOrFail($this->editingId);
            $this->authorize('update', $word);
            $word->update($data);
        } else {
            Word::create([...$data, 'user_id' => Auth::id()]);
        }

        $this->reset('original', 'pronunciation', 'translation', 'groupId', 'editingId', 'showForm', 'showNewGroupInput', 'newGroupName');
    }

    public function delete(int $wordId): void
    {
        $word = Word::where('user_id', Auth::id())->findOrFail($wordId);
        $this->authorize('delete', $word);
        $word->delete();
    }

    public function toggleStar(int $wordId): void
    {
        $word = Word::where('user_id', Auth::id())->findOrFail($wordId);
        $this->authorize('update', $word);
        $word->update(['is_starred' => ! $word->is_starred]);
    }

    public function render()
    {
        $query = Word::where('user_id', Auth::id())->with('group');

        if ($this->filterGroupId === 'none') {
            $query->whereNull('group_id');
        } elseif ($this->filterGroupId !== '') {
            $query->where('group_id', (int) $this->filterGroupId);
        }

        if ($this->onlyStarred) {
            $query->where('is_starred', true);
        }

        $term = trim($this->search);

        if ($term !== '') {
            // Matches the original word, the pronunciation or the translation.
            // The utf8mb4_unicode_ci collation is accent- and case-insensitive ("citta" finds "città").
            $like = '%'.addcslashes($term, '%_\\').'%';

            $query->where(function ($q) use ($like) {
                $q->where('original', 'like', $like)
                    ->orWhere('pronunciation', 'like', $like)
                    ->orWhere('translation', 'like', $like);
            });
        }

        $audioMissing = count(app(TtsService::class)->wordsMissingAudio(Auth::id()));

        return view('livewire.dictionary.index', [
            'audioMissing' => $audioMissing,
            'words' => $query->orderByDesc('id')->get(),
            'groups' => Group::where('user_id', Auth::id())
                ->orderBy('name')
                ->get(),
        ]);
    }
}
