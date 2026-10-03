<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Oyun') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($total === 0)
                <div class="bg-white p-6 shadow-sm sm:rounded-lg text-center space-y-4">
                    <p class="text-gray-600">{{ __('Bu dəstədə söz yoxdur.') }}</p>
                    <a href="{{ route('game.setup') }}" wire:navigate class="text-indigo-600 underline">{{ __('Oyun ekranına qayıt') }}</a>
                </div>

            @elseif ($finished)
                <div class="bg-white p-6 shadow-sm sm:rounded-lg text-center space-y-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Nəticə') }}</h3>
                    @if (in_array($mode, ['flash_original', 'flash_translation'], true))
                        <p class="text-3xl font-bold text-indigo-600">{{ __(':total söz təkrarlandı', ['total' => $total]) }}</p>
                    @else
                        <p class="text-3xl font-bold text-indigo-600">{{ $score }} / {{ $total }}</p>
                    @endif

                    <div class="flex items-center justify-center gap-3">
                        <x-primary-button type="button" wire:click="restart(false)">
                            {{ __('Yenidən bütün sözlərlə') }}
                        </x-primary-button>

                        @if (count($wrongWordIds) > 0)
                            <x-secondary-button type="button" wire:click="restart(true)">
                                {{ __('Yalnız səhvləri təkrarla') }}
                            </x-secondary-button>
                        @endif
                    </div>

                    <div>
                        <a href="{{ route('game.setup') }}" wire:navigate class="text-sm text-gray-500 underline">{{ __('Oyun ekranına qayıt') }}</a>
                    </div>
                </div>

            @else
                @php
                    $isCardMode = in_array($mode, ['flash_original', 'flash_translation'], true);
                    $showsOriginalFirst = in_array($mode, ['original_to_translation', 'flash_original'], true);
                @endphp

                <div class="bg-white p-6 shadow-sm sm:rounded-lg space-y-6">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>{{ __('Sual :current / :total', ['current' => $currentIndex + 1, 'total' => $total]) }}</span>

                        <div class="flex items-center gap-3">
                            @unless ($isCardMode)
                                <span>{{ __('Nəticə: :score', ['score' => $score]) }}</span>
                            @endunless

                            <button type="button" wire:click="toggleStar" class="text-xl {{ $currentStarred ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-400' }}" title="{{ __('Ulduzla') }}">
                                {{ $currentStarred ? '★' : '☆' }}
                            </button>
                        </div>
                    </div>

                    <div class="text-center space-y-1">
                        @if ($showsOriginalFirst)
                            <p class="text-2xl font-semibold text-gray-900">{{ $currentWord->original }}</p>
                            @if ($currentWord->pronunciation)
                                <p class="text-gray-500">[{{ $currentWord->pronunciation }}]</p>
                            @endif
                        @else
                            <p class="text-2xl font-semibold text-gray-900">{{ $currentWord->translation }}</p>
                        @endif
                    </div>

                    @if ($feedback)
                        <div class="text-center rounded-md p-3 {{ $feedback === 'correct' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                            @if ($feedback === 'correct')
                                {{ __('Düzgündür!') }}
                            @else
                                {{ __('Səhvdir. Düzgün cavab: :answer', ['answer' => $feedbackCorrectLabel]) }}
                            @endif
                        </div>
                    @endif

                    @if ($mode === 'typing')
                        <form wire:submit="submitTyped" class="space-y-4">
                            <x-text-input wire:model="typedAnswer" type="text" class="block w-full text-center" :disabled="$answered" autofocus />

                            @if (! $answered)
                                <div class="text-center">
                                    <x-primary-button type="submit">{{ __('Yoxla') }}</x-primary-button>
                                </div>
                            @endif
                        </form>
                    @elseif ($isCardMode)
                        <div class="text-center space-y-4">
                            @if ($revealed)
                                <div class="rounded-md bg-gray-50 p-4">
                                    @if ($mode === 'flash_original')
                                        <p class="text-xl font-semibold text-gray-900">{{ $currentWord->translation }}</p>
                                    @else
                                        <p class="text-xl font-semibold text-gray-900">{{ $currentWord->original }}</p>
                                        @if ($currentWord->pronunciation)
                                            <p class="text-gray-500">[{{ $currentWord->pronunciation }}]</p>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <x-secondary-button type="button" wire:click="reveal">
                                    {{ $mode === 'flash_original' ? __('Tərcüməyə bax') : __('Orijinala bax') }}
                                </x-secondary-button>
                            @endif

                            <div class="flex items-center justify-center gap-3">
                                @if ($currentIndex > 0)
                                    <x-secondary-button type="button" wire:click="previous">← {{ __('Geri') }}</x-secondary-button>
                                @endif
                                <x-primary-button type="button" wire:click="next">{{ __('İrəli') }}</x-primary-button>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-3">
                            @foreach ($options as $option)
                                <button
                                    type="button"
                                    wire:click="submitChoice({{ $option['id'] }})"
                                    @disabled($answered)
                                    class="border rounded-lg p-3 text-center transition
                                        {{ $answered && $option['id'] === $currentWordId ? 'border-green-500 bg-green-50' : '' }}
                                        {{ $answered && $feedback === 'incorrect' && $option['id'] !== $currentWordId ? 'opacity-50' : '' }}
                                        {{ ! $answered ? 'border-gray-200 hover:border-indigo-400' : '' }}"
                                >
                                    {{ $option['label'] }}
                                </button>
                            @endforeach
                        </div>
                    @endif

                    @unless ($isCardMode)
                        <div class="flex items-center justify-center gap-3">
                            @if ($currentIndex > 0)
                                <x-secondary-button type="button" wire:click="previous">← {{ __('Geri') }}</x-secondary-button>
                            @endif
                            @if ($answered)
                                <x-primary-button type="button" wire:click="next">{{ __('Növbəti sual') }}</x-primary-button>
                            @endif
                        </div>
                    @endunless
                </div>
            @endif
        </div>
    </div>
</div>
