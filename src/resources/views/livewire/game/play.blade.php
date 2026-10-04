<div>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">{{ __('Oyun') }}</h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-2xl mx-auto px-0 sm:px-6 lg:px-8">

            @if ($total === 0)
                <div class="bg-white p-6 shadow-sm sm:rounded-xl text-center space-y-4">
                    <p class="text-4xl">{{ $group === 'due' ? '🎉' : '📭' }}</p>
                    <p class="text-gray-600">
                        {{ $group === 'due' ? __('Bu gün təkrar lazım olan söz yoxdur. Əla!') : __('Bu dəstədə söz yoxdur.') }}
                    </p>
                    <a href="{{ route('game.setup') }}" wire:navigate class="text-indigo-600 underline">{{ __('Oyun ekranına qayıt') }}</a>
                </div>

            @elseif ($finished)
                @php
                    $pct = $total > 0 ? round($score / $total * 100) : 0;
                @endphp
                <div class="bg-white p-6 shadow-sm sm:rounded-xl text-center space-y-6">
                    <p class="text-5xl">{{ $pct >= 90 ? '🏆' : ($pct >= 60 ? '👏' : '💪') }}</p>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Nəticə') }}</h3>
                    <p class="text-4xl font-bold text-indigo-600">{{ $score }} / {{ $total }}</p>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden max-w-xs mx-auto">
                        <div class="h-full bg-indigo-500" style="width: {{ $pct }}%"></div>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <x-primary-button type="button" wire:click="restart(false)">
                            {{ $group === 'due' ? __('Yeni təkrar') : __('Yenidən bütün sözlərlə') }}
                        </x-primary-button>

                        @if (count($wrongWordIds) > 0)
                            <x-secondary-button type="button" wire:click="restart(true)">
                                {{ __('Yalnız səhvləri təkrarla (:n)', ['n' => count($wrongWordIds)]) }}
                            </x-secondary-button>
                        @endif
                    </div>

                    <div class="flex items-center justify-center gap-4 text-sm">
                        <a href="{{ route('game.setup') }}" wire:navigate class="text-gray-500 underline">{{ __('Oyun ekranına qayıt') }}</a>
                        <a href="{{ route('dashboard') }}" wire:navigate class="text-gray-500 underline">{{ __('Ana səhifə') }}</a>
                    </div>
                </div>

            @else
                @php
                    $isCardMode = in_array($mode, ['flash_original', 'flash_translation'], true);
                    $showsOriginalFirst = in_array($mode, ['original_to_translation', 'flash_original'], true);
                    $progress = $total > 0 ? round($currentIndex / $total * 100) : 0;
                @endphp

                <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden">
                    <div class="h-1.5 bg-gray-100">
                        <div class="h-full bg-indigo-500 transition-all duration-300" style="width: {{ $progress }}%"></div>
                    </div>

                    <div class="p-4 sm:p-6 space-y-5 sm:space-y-6"
                         x-data="{ auto: false }"
                         x-init="window.__autoSpeak = false">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ __('Sual :current / :total', ['current' => $currentIndex + 1, 'total' => $total]) }}</span>

                            <div class="flex items-center gap-3">
                                <span>{{ __('Nəticə: :score', ['score' => $score]) }}</span>

                                <button type="button"
                                        x-on:click="auto = !auto; window.__autoSpeak = auto"
                                        :class="auto ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'bg-white text-gray-400 border-gray-200'"
                                        class="inline-flex items-center gap-1 rounded-full border px-2 py-0.5 text-xs leading-5"
                                        title="{{ __('Avtomatik səsləndirmə') }}">
                                    <span>🔊</span>
                                    <span x-text="auto ? '{{ __('Avto: açıq') }}' : '{{ __('Avto: bağlı') }}'"></span>
                                </button>

                                <button type="button" wire:click="toggleStar" class="text-xl leading-none {{ $currentStarred ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-400' }}" title="{{ __('Ulduzla') }}">
                                    {{ $currentStarred ? '★' : '☆' }}
                                </button>
                            </div>
                        </div>

                        <div class="text-center space-y-1 py-2"
                             wire:key="q-{{ $currentIndex }}-{{ $currentWordId }}"
                             @if ($showsOriginalFirst) x-init="window.autoSpeak && window.autoSpeak(@js($currentWord->original))" @endif>
                            @if ($showsOriginalFirst)
                                <p class="text-3xl font-bold text-gray-900 break-words">
                                    {{ $currentWord->original }}
                                    <button type="button" class="ml-1 text-xl align-middle text-gray-400 hover:text-indigo-600" title="{{ __('Səsləndir') }}"
                                            x-on:click="window.speakItalian(@js($currentWord->original))">🔊</button>
                                </p>
                                @if ($currentWord->pronunciation)
                                    <p class="text-gray-500">[{{ $currentWord->pronunciation }}]</p>
                                @endif
                            @else
                                <p class="text-3xl font-bold text-gray-900 break-words">{{ $currentWord->translation }}</p>
                            @endif
                        </div>

                        @if ($feedback)
                            <div class="text-center rounded-lg p-3 {{ $feedback === 'correct' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}"
                                 wire:key="fb-{{ $currentIndex }}-{{ $feedback }}"
                                 @if (! $showsOriginalFirst) x-init="window.autoSpeak && window.autoSpeak(@js($currentWord->original))" @endif>
                                @if ($feedback === 'correct')
                                    {{ __('Düzgündür!') }}
                                @else
                                    {{ __('Səhvdir. Düzgün cavab: :answer', ['answer' => $feedbackCorrectLabel]) }}
                                @endif

                                @if (! $showsOriginalFirst)
                                    <div class="mt-2 flex items-center justify-center gap-2 text-gray-900">
                                        <span class="text-lg font-semibold">{{ $currentWord->original }}</span>
                                        <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-lg shadow-sm hover:bg-indigo-50" title="{{ __('Səsləndir') }}"
                                                x-on:click="window.speakItalian(@js($currentWord->original))">🔊</button>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($mode === 'typing')
                            <form wire:submit="submitTyped" class="space-y-4">
                                <x-text-input wire:model="typedAnswer" type="text" class="block w-full text-center" :disabled="$answered" autofocus autocomplete="off" autocapitalize="off" />

                                @if (! $answered)
                                    <div class="text-center">
                                        <x-primary-button type="submit">{{ __('Yoxla') }}</x-primary-button>
                                    </div>
                                @endif
                            </form>
                        @elseif ($isCardMode)
                            <div class="text-center space-y-4">
                                @if ($revealed)
                                    <div class="rounded-lg bg-gray-50 p-4"
                                         @if ($mode === 'flash_translation') x-init="window.autoSpeak && window.autoSpeak(@js($currentWord->original))" @endif>
                                        @if ($mode === 'flash_original')
                                            <p class="text-xl font-semibold text-gray-900">{{ $currentWord->translation }}</p>
                                        @else
                                            <p class="text-xl font-semibold text-gray-900">
                                                {{ $currentWord->original }}
                                                <button type="button" class="ml-1 align-middle text-gray-400 hover:text-indigo-600" title="{{ __('Səsləndir') }}"
                                                        x-on:click="window.speakItalian(@js($currentWord->original))">🔊</button>
                                            </p>
                                            @if ($currentWord->pronunciation)
                                                <p class="text-gray-500">[{{ $currentWord->pronunciation }}]</p>
                                            @endif
                                        @endif
                                    </div>

                                    <p class="text-sm text-gray-500">{{ __('Bu sözü bilirdinizmi?') }}</p>
                                    <div class="flex items-center justify-center gap-3">
                                        <x-secondary-button type="button" wire:click="markKnown(false)" data-dontknow>✗ {{ __('Bilmədim') }}</x-secondary-button>
                                        <x-primary-button type="button" wire:click="markKnown(true)" data-know>✓ {{ __('Bildim') }}</x-primary-button>
                                    </div>
                                @else
                                    <x-primary-button type="button" wire:click="reveal" data-reveal>
                                        {{ $mode === 'flash_original' ? __('Tərcüməyə bax') : __('Orijinala bax') }}
                                    </x-primary-button>
                                @endif
                            </div>
                        @else
                            <div class="grid gap-3">
                                @foreach ($options as $i => $option)
                                    <button
                                        type="button"
                                        wire:click="submitChoice({{ $option['id'] }})"
                                        data-option
                                        @disabled($answered)
                                        class="flex items-center gap-3 border rounded-lg p-3 text-left transition
                                            {{ $answered && $option['id'] === $currentWordId ? 'border-green-500 bg-green-50' : '' }}
                                            {{ $answered && $feedback === 'incorrect' && $option['id'] !== $currentWordId ? 'opacity-50' : '' }}
                                            {{ ! $answered ? 'border-gray-200 hover:border-indigo-400 hover:bg-indigo-50/40' : '' }}"
                                    >
                                        <span class="hidden sm:inline-flex h-6 w-6 shrink-0 items-center justify-center rounded bg-gray-100 text-xs text-gray-500">{{ $i + 1 }}</span>
                                        <span class="flex-1 text-center sm:text-left break-words">{{ $option['label'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex items-center justify-center gap-3">
                            @if ($currentIndex > 0)
                                <x-secondary-button type="button" wire:click="previous" data-prev>← {{ __('Geri') }}</x-secondary-button>
                            @endif
                            @if ($answered && ! $isCardMode)
                                <x-primary-button type="button" wire:click="next" data-next>{{ __('Növbəti sual') }} →</x-primary-button>
                            @endif
                        </div>

                        <p class="hidden sm:block text-center text-xs text-gray-400">
                            @if ($isCardMode)
                                {{ __('Qısayollar: Boşluq — göstər · → bildim · ← geri') }}
                            @elseif ($mode === 'typing')
                                {{ __('Qısayollar: Enter — yoxla / növbəti · ← geri') }}
                            @else
                                {{ __('Qısayollar: 1–5 — seç · Enter — növbəti · ← geri') }}
                            @endif
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
