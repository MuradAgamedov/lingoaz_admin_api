<div>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">{{ __('Ana səhifə') }}</h2>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Today's call to action --}}
            <div class="rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-5 sm:p-7 shadow-sm">
                <p class="text-indigo-100 text-sm">{{ __('Salam, :name 👋', ['name' => auth()->user()->name]) }}</p>
                <h3 class="text-2xl font-bold mt-1">
                    @if ($dueCount > 0)
                        {{ __('Bu gün :count söz təkrar gözləyir', ['count' => $dueCount]) }}
                    @else
                        {{ __('Bu gün üçün hər şey hazırdır 🎉') }}
                    @endif
                </h3>
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('game.setup', ['group' => 'due']) }}" wire:navigate
                       class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-indigo-700 shadow-sm hover:bg-indigo-50">
                        📅 {{ __('Günün təkrarına başla') }}
                    </a>
                    @if ($hardCount > 0)
                        <a href="{{ route('game.setup', ['group' => 'hard']) }}" wire:navigate
                           class="inline-flex items-center rounded-lg bg-white/15 px-4 py-2 text-sm font-semibold text-white hover:bg-white/25">
                            🔥 {{ __('Çətin sözlər (:count)', ['count' => $hardCount]) }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- Stat tiles --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-gray-500">{{ __('Ümumi söz') }}</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-gray-500">{{ __('Öyrənilib') }}</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ $mastered }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-gray-500">{{ __('Ardıcıl gün') }}</p>
                    <p class="text-2xl font-bold text-orange-500 mt-1">🔥 {{ $streak }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-xs text-gray-500">{{ __('Bu gün') }}</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $todayTotal }}
                        @if ($todayAccuracy !== null)
                            <span class="text-sm font-medium text-gray-400">· {{ $todayAccuracy }}%</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
                {{-- Overall progress --}}
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h4 class="font-semibold text-gray-900 mb-3">{{ __('Ümumi irəliləyiş') }}</h4>
                    @if ($total > 0)
                        <div class="flex h-3 rounded-full overflow-hidden bg-gray-100">
                            <div class="bg-green-500" style="width: {{ $mastered / $total * 100 }}%"></div>
                            <div class="bg-amber-400" style="width: {{ $learning / $total * 100 }}%"></div>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-3 text-sm text-gray-600">
                            <span><span class="inline-block h-2 w-2 rounded-full bg-green-500"></span> {{ __('Öyrənilib') }}: {{ $mastered }}</span>
                            <span><span class="inline-block h-2 w-2 rounded-full bg-amber-400"></span> {{ __('Öyrənilir') }}: {{ $learning }}</span>
                            <span><span class="inline-block h-2 w-2 rounded-full bg-gray-300"></span> {{ __('Yeni') }}: {{ $fresh }}</span>
                        </div>
                    @else
                        <p class="text-sm text-gray-400">{{ __('Hələ söz yoxdur.') }}</p>
                    @endif
                </div>

                {{-- Last 7 days --}}
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h4 class="font-semibold text-gray-900 mb-3">{{ __('Son 7 gün') }}</h4>
                    <div class="flex items-end justify-between gap-2 h-28">
                        @foreach ($week as $day)
                            <div class="flex-1 flex flex-col items-center justify-end h-full gap-1">
                                <span class="text-[10px] text-gray-400">{{ $day['count'] ?: '' }}</span>
                                <div class="w-full rounded-t {{ $day['today'] ? 'bg-indigo-500' : 'bg-indigo-200' }}"
                                     style="height: {{ max(4, $day['count'] / $weekMax * 80) }}%"></div>
                                <span class="text-xs {{ $day['today'] ? 'font-semibold text-indigo-600' : 'text-gray-400' }}">{{ $day['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Per-group progress --}}
            @if ($groups->isNotEmpty())
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h4 class="font-semibold text-gray-900 mb-4">{{ __('Qruplar üzrə') }}</h4>
                    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4">
                        @foreach ($groups as $group)
                            @php $pct = $group->words_count > 0 ? round($group->mastered_count / $group->words_count * 100) : 0; @endphp
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-800 truncate">{{ $group->name }}</span>
                                    <span class="text-gray-500 shrink-0 ml-2">
                                        @if ($group->words_count === 0)
                                            {{ __('boşdur') }}
                                        @else
                                            {{ $group->mastered_count }}/{{ $group->words_count }}
                                        @endif
                                    </span>
                                </div>
                                <div class="h-2 mt-1 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-green-500" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
