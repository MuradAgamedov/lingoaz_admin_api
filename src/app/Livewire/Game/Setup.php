<?php

namespace App\Livewire\Game;

use App\Models\Group;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Setup extends Component
{
    public string $group = 'all';

    public string $mode = 'original_to_translation';

    public array $selectedWordIds = [];

    public bool $selectAll = false;

    public string $filterGroup = 'all';

    public string $search = '';

    private function filteredWordsQuery()
    {
        $query = Word::where('user_id', Auth::id());

        if ($this->filterGroup === 'none') {
            $query->whereNull('group_id');
        } elseif ($this->filterGroup !== 'all') {
            $query->where('group_id', (int) $this->filterGroup);
        }

        $term = trim($this->search);

        if ($term !== '') {
            $like = '%'.addcslashes($term, '%_\\').'%';

            $query->where(function ($q) use ($like) {
                $q->where('original', 'like', $like)
                    ->orWhere('translation', 'like', $like)
                    ->orWhere('pronunciation', 'like', $like);
            });
        }

        return $query;
    }

    public function updatedSelectAll(bool $value): void
    {
        $visibleIds = $this->filteredWordsQuery()->pluck('id')->map(fn ($id) => (string) $id)->all();

        $this->selectedWordIds = $value
            ? array_values(array_unique(array_merge($this->selectedWordIds, $visibleIds)))
            : array_values(array_diff($this->selectedWordIds, $visibleIds));
    }

    public function updatedSearch(): void
    {
        $this->updatedFilterGroup();
    }

    public function updatedFilterGroup(): void
    {
        $visibleIds = $this->filteredWordsQuery()->pluck('id')->map(fn ($id) => (string) $id)->all();

        $this->selectAll = $visibleIds !== [] && count(array_diff($visibleIds, $this->selectedWordIds)) === 0;
    }

    public function start()
    {
        $params = ['mode' => $this->mode, 'group' => $this->group];

        if ($this->group === 'custom') {
            $params['ids'] = implode(',', $this->selectedWordIds);
        }

        return $this->redirect(route('game.play', $params), navigate: true);
    }

    public function render()
    {
        return view('livewire.game.setup', [
            'groups' => Group::where('user_id', Auth::id())->orderBy('name')->get(),
            'allWords' => $this->filteredWordsQuery()->with('group')->orderByDesc('id')->get(),
        ]);
    }
}
