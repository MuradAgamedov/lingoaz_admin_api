<?php

namespace App\Livewire\Dictionary;

use App\Models\Group;
use App\Models\Word;
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

    public function startCreate(): void
    {
        $this->reset('original', 'pronunciation', 'translation', 'groupId', 'editingId', 'showNewGroupInput', 'newGroupName');
        $this->showForm = true;
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

        return view('livewire.dictionary.index', [
            'words' => $query->orderByDesc('id')->get(),
            'groups' => Group::where('user_id', Auth::id())
                ->orderBy('name')
                ->get(),
        ]);
    }
}
