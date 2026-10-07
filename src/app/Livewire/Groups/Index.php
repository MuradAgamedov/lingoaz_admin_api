<?php

namespace App\Livewire\Groups;

use App\Models\Group;
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
    public string $name = '';

    public function startCreate(): void
    {
        $this->savedMessage = null;
        $this->reset('name', 'editingId');
        $this->showForm = true;
    }

    public function startEdit(int $groupId): void
    {
        $this->savedMessage = null;
        $group = Group::where('user_id', Auth::id())->findOrFail($groupId);

        $this->editingId = $group->id;
        $this->name = $group->name;
        $this->showForm = true;
    }

    public function cancel(): void
    {
        $this->reset('name', 'editingId', 'showForm');
    }

    public ?string $savedMessage = null;

    public function save(): void
    {
        $this->validate();
        $this->savedMessage = null;

        if ($this->editingId) {
            $group = Group::where('user_id', Auth::id())->findOrFail($this->editingId);
            $this->authorize('update', $group);
            $group->update(['name' => $this->name]);
            $this->savedMessage = __('«:name» qrupu yeniləndi', ['name' => $this->name]);
        } else {
            Group::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
            ]);
            $this->savedMessage = __('«:name» qrupu yaradıldı', ['name' => $this->name]);
        }

        $this->reset('name', 'editingId', 'showForm');
    }

    public function delete(int $groupId): void
    {
        $group = Group::where('user_id', Auth::id())->findOrFail($groupId);
        $this->authorize('delete', $group);
        $group->delete();
    }

    public function render()
    {
        return view('livewire.groups.index', [
            'groups' => Group::where('user_id', Auth::id())
                ->withCount('words')
                ->get()
                ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                ->values(),   // natural order: Lezione 2 comes before Lezione 10
        ]);
    }
}
