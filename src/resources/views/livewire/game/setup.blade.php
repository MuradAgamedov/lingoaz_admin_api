<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Oyun') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Söz dəstəsini seçin') }}</h3>

                <div class="space-y-2">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="group_choice" wire:model.live="group" value="all">
                        <span>{{ __('Bütün sözlər') }}</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="group_choice" wire:model.live="group" value="starred">
                        <span>⭐ {{ __('Ulduzlu sözlər') }}</span>
                    </label>

                    @foreach ($groups as $g)
                        <label class="flex items-center gap-2">
                            <input type="radio" name="group_choice" wire:model.live="group" value="{{ $g->id }}">
                            <span>{{ $g->name }}</span>
                        </label>
                    @endforeach

                    <label class="flex items-center gap-2">
                        <input type="radio" name="group_choice" wire:model.live="group" value="custom">
                        <span>{{ __('Konkret sözlər') }}</span>
                    </label>

                    @if ($groups->isEmpty())
                        <p class="text-gray-400 text-sm">{{ __('Hələ qrup yoxdur, amma bütün sözlərlə oynaya bilərsiniz.') }}</p>
                    @endif
                </div>

                @if ($group === 'custom')
                    <div class="mt-4 border-t pt-4">
                        <div class="mb-3">
                            <label for="filterGroup" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Qrup üzrə filter') }}</label>
                            <select id="filterGroup" wire:model.live="filterGroup" class="border-gray-300 rounded-md shadow-sm text-sm w-full sm:w-64">
                                <option value="all">{{ __('Bütün qruplar') }}</option>
                                @foreach ($groups as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                                <option value="none">{{ __('Qrupsuz') }}</option>
                            </select>
                        </div>

                        <label class="flex items-center gap-2 font-medium text-gray-900 mb-3">
                            <input type="checkbox" wire:model.live="selectAll">
                            <span>{{ __('Hamısını seç') }}</span>
                        </label>

                        <div class="max-h-80 overflow-y-auto border rounded-md divide-y divide-gray-100">
                            @forelse ($allWords as $w)
                                <label class="flex items-center gap-2 px-3 py-2 hover:bg-gray-50">
                                    <input type="checkbox" wire:model.live="selectedWordIds" value="{{ $w->id }}">
                                    <span class="text-gray-900">{{ $w->original }}</span>
                                    <span class="text-gray-400 text-sm">— {{ $w->translation }}</span>
                                    @if ($w->group)
                                        <span class="text-gray-400 text-xs ml-auto">{{ $w->group->name }}</span>
                                    @endif
                                </label>
                            @empty
                                <p class="text-gray-400 text-sm px-3 py-2">{{ __('Hələ söz yoxdur.') }}</p>
                            @endforelse
                        </div>

                        <p class="text-sm text-gray-500 mt-2">{{ __(':count söz seçildi', ['count' => count($selectedWordIds)]) }}</p>
                    </div>
                @endif
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Oyun rejimini seçin') }}</h3>

                <div class="grid sm:grid-cols-3 gap-4">
                    <label class="border rounded-lg p-4 cursor-pointer {{ $mode === 'original_to_translation' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200' }}">
                        <input type="radio" name="mode_choice" wire:model.live="mode" value="original_to_translation" class="sr-only">
                        <div class="font-medium text-gray-900">{{ __('Orijinaldan tərcüməyə') }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('Seçim (5 variant)') }}</div>
                    </label>

                    <label class="border rounded-lg p-4 cursor-pointer {{ $mode === 'translation_to_original' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200' }}">
                        <input type="radio" name="mode_choice" wire:model.live="mode" value="translation_to_original" class="sr-only">
                        <div class="font-medium text-gray-900">{{ __('Tərcümədən orijinala') }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('Seçim (5 variant)') }}</div>
                    </label>

                    <label class="border rounded-lg p-4 cursor-pointer {{ $mode === 'typing' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200' }}">
                        <input type="radio" name="mode_choice" wire:model.live="mode" value="typing" class="sr-only">
                        <div class="font-medium text-gray-900">{{ __('Tərcümədən orijinala') }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('Yazı ilə') }}</div>
                    </label>

                    <label class="border rounded-lg p-4 cursor-pointer {{ $mode === 'flash_original' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200' }}">
                        <input type="radio" name="mode_choice" wire:model.live="mode" value="flash_original" class="sr-only">
                        <div class="font-medium text-gray-900">{{ __('Orijinaldan tərcüməyə') }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('Kart (bax düyməsi)') }}</div>
                    </label>

                    <label class="border rounded-lg p-4 cursor-pointer {{ $mode === 'flash_translation' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200' }}">
                        <input type="radio" name="mode_choice" wire:model.live="mode" value="flash_translation" class="sr-only">
                        <div class="font-medium text-gray-900">{{ __('Tərcümədən orijinala') }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('Kart (bax düyməsi)') }}</div>
                    </label>
                </div>
            </div>

            <div>
                <x-primary-button type="button" wire:click="start">{{ __('Başla') }}</x-primary-button>
            </div>
        </div>
    </div>
</div>
