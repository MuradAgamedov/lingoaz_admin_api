<div>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">{{ __('Lüğət') }}</h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-0 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">

            @if ($showForm)
                <div class="bg-white p-4 sm:p-6 shadow-sm sm:rounded-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ $editingId ? __('Sözü redaktə et') : __('Yeni söz əlavə et') }}
                    </h3>

                    <form wire:submit="save" class="space-y-4">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="original" :value="__('Orijinal söz')" />
                                <x-text-input wire:model="original" id="original" type="text" class="mt-1 block w-full" autofocus />
                                <x-input-error :messages="$errors->get('original')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="pronunciation" :value="__('Oxunuşu')" />
                                <x-text-input wire:model="pronunciation" id="pronunciation" type="text" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('pronunciation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-3">
                                <x-secondary-button type="button" wire:click="suggest" wire:loading.attr="disabled" wire:target="suggest">
                                    <span wire:loading.remove wire:target="suggest">✨ {{ __('Tərcümə və oxunuş təklif et') }}</span>
                                    <span wire:loading wire:target="suggest">⏳ {{ __('Düşünür...') }}</span>
                                </x-secondary-button>
                                @if ($suggestionNote)
                                    <span class="text-xs text-red-600">{{ $suggestionNote }}</span>
                                @endif
                            </div>

                            @if (count($suggestions) > 0)
                                <div class="flex flex-wrap items-center gap-2 text-sm">
                                    <span class="text-gray-500">{{ __('Variantlar:') }}</span>
                                    @foreach ($suggestions as $i => $option)
                                        <button type="button" wire:click="useSuggestion({{ $i }})"
                                                class="rounded-full border px-3 py-1 {{ $translation === $option ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-gray-300 bg-white text-gray-700 hover:border-indigo-400' }}">
                                            {{ $option }}
                                        </button>
                                    @endforeach
                                    <span class="text-xs text-gray-400">{{ __('AI təklifidir, yoxlayın') }}</span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="translation" :value="__('Tərcümə')" />
                            <x-text-input wire:model="translation" id="translation" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('translation')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="groupId" :value="__('Qrup')" />

                            <div class="flex flex-wrap items-center gap-3 mt-1">
                                <select wire:model="groupId" id="groupId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full sm:flex-1 sm:w-auto">
                                    <option value="">{{ __('Qrupsuz') }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>

                                <x-secondary-button type="button" wire:click="$toggle('showNewGroupInput')">
                                    {{ __('+ Yeni qrup') }}
                                </x-secondary-button>
                            </div>

                            @if ($showNewGroupInput)
                                <div class="flex items-center gap-3 mt-3">
                                    <x-text-input wire:model="newGroupName" type="text" class="block w-full" :placeholder="__('Qrup adı')" />
                                    <x-secondary-button type="button" wire:click="createGroupInline">{{ __('Əlavə et') }}</x-secondary-button>
                                </div>
                                <x-input-error :messages="$errors->get('newGroupName')" class="mt-2" />
                            @endif
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button type="submit">{{ __('Yadda saxla') }}</x-primary-button>
                            <x-secondary-button type="button" wire:click="cancel">{{ __('Ləğv et') }}</x-secondary-button>
                        </div>
                    </form>
                </div>
            @elseif ($showBulk)
                <div class="bg-white p-4 sm:p-6 shadow-sm sm:rounded-xl">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ __('Çoxlu söz əlavə et') }}</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        {{ __('Hər sətirdə bir söz. Format:') }}
                        <code class="bg-gray-100 rounded px-1">söz | oxunuş | tərcümə</code>
                        {{ __('və ya') }}
                        <code class="bg-gray-100 rounded px-1">söz - tərcümə</code>
                        {{ __('və ya yalnız italyanca söz: tərcümə və oxunuş AI ilə doldurulur (sonra yoxlayın).') }}
                    </p>

                    <form wire:submit="saveBulk" class="space-y-4">
                        <div>
                            <textarea wire:model="bulkText" rows="8" class="block w-full border-gray-300 rounded-lg shadow-sm text-sm font-mono focus:border-indigo-500 focus:ring-indigo-500" placeholder="ponte | ponte | körpü&#10;rete - şəbəkə"></textarea>
                            <x-input-error :messages="$errors->get('bulkText')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="bulkGroupId" :value="__('Qrup')" />
                            <select wire:model="bulkGroupId" id="bulkGroupId" class="mt-1 block w-full sm:w-64 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">{{ __('Qrupsuz') }}</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($bulkResult)
                            <p class="text-sm rounded-lg bg-green-50 text-green-700 px-3 py-2">{{ $bulkResult }}</p>
                        @endif

                        <div class="flex items-center gap-3">
                            <x-primary-button type="submit">{{ __('Əlavə et') }}</x-primary-button>
                            <x-secondary-button type="button" wire:click="closeBulk">{{ __('Bağla') }}</x-secondary-button>
                        </div>
                    </form>
                </div>
            @else
                <div class="px-4 sm:px-0 flex flex-wrap gap-3">
                    <x-primary-button type="button" wire:click="startCreate">{{ __('+ Yeni söz əlavə et') }}</x-primary-button>
                    <x-secondary-button type="button" wire:click="openBulk">{{ __('Çoxlu əlavə et') }}</x-secondary-button>
                </div>
            @endif

            @if ($audioMissing > 0 || $audioGenerating || $audioMessage)
                <div class="px-4 sm:px-0" @if ($audioGenerating) wire:poll.3s="refreshAudio" @endif>
                    <div class="flex flex-wrap items-center gap-3 rounded-xl border px-4 py-3 text-sm
                                {{ $audioGenerating ? 'border-indigo-200 bg-indigo-50 text-indigo-800' : ($audioMissing > 0 ? 'border-amber-200 bg-amber-50 text-amber-900' : 'border-green-200 bg-green-50 text-green-800') }}">
                        @if ($audioGenerating)
                            <span class="animate-pulse">⏳</span>
                            <span>{{ __('Səslər arxa fonda yaradılır… qalıb: :n söz', ['n' => $audioMissing]) }}</span>
                        @elseif ($audioMissing > 0)
                            <span>🔇 {{ __(':n sözün səsi hələ yoxdur', ['n' => $audioMissing]) }}</span>
                            <x-primary-button type="button" wire:click="generateAudio" class="!py-1.5">🎙 {{ __('Səsləri yarat') }}</x-primary-button>
                            @if ($audioMessage)
                                <span class="text-xs opacity-80">{{ $audioMessage }}</span>
                            @endif
                        @else
                            <span>{{ $audioMessage }}</span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="px-4 sm:px-0">
                <div class="relative w-full sm:max-w-md">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-gray-400">🔍</span>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        id="search"
                        autocomplete="off"
                        placeholder="{{ __('Söz, oxunuş və ya tərcümə axtar...') }}"
                        aria-label="{{ __('Axtarış') }}"
                        class="block w-full rounded-lg border-gray-300 pl-10 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>
                @if (trim($search) !== '')
                    <p class="mt-2 text-xs text-gray-500">
                        {{ __(':count nəticə tapıldı', ['count' => $words->count()]) }}
                    </p>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-2 sm:gap-3 px-4 sm:px-0">
                <x-input-label for="filterGroupId" :value="__('Qrupa görə filtrlə:')" />
                <select wire:model.live="filterGroupId" id="filterGroupId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full sm:w-auto">
                    <option value="">{{ __('Bütün sözlər') }}</option>
                    <option value="none">{{ __('Qrupsuz') }}</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>

                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" wire:model.live="onlyStarred" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span>⭐ {{ __('Yalnız ulduzlu sözlər') }}</span>
                </label>
            </div>

            <div class="hidden sm:block bg-white shadow-sm sm:rounded-xl overflow-x-auto">
                <table class="w-full min-w-[40rem] text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-3 lg:px-6 py-3"></th>
                            <th class="px-3 lg:px-6 py-3">{{ __('Orijinal söz') }}</th>
                            <th class="px-3 lg:px-6 py-3">{{ __('Oxunuşu') }}</th>
                            <th class="px-3 lg:px-6 py-3">{{ __('Tərcümə') }}</th>
                            <th class="px-3 lg:px-6 py-3">{{ __('Qrup') }}</th>
                            <th class="px-3 lg:px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($words as $word)
                            <tr wire:key="word-{{ $word->id }}">
                                <td class="px-3 lg:px-6 py-4">
                                    <button wire:click="toggleStar({{ $word->id }})" class="text-lg {{ $word->is_starred ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-400' }}" title="{{ __('Ulduzla') }}">
                                        {{ $word->is_starred ? '★' : '☆' }}
                                    </button>
                                </td>
                                <td class="px-3 lg:px-6 py-4 text-gray-900">{{ $word->original }} <button type="button" class="ml-1 text-gray-300 hover:text-indigo-600" title="{{ __('Səsləndir') }}" data-text="{{ $word->original }}" onclick="window.speakItalian(this.dataset.text)">🔊</button></td>
                                <td class="px-3 lg:px-6 py-4 text-gray-600">{{ $word->pronunciation }}</td>
                                <td class="px-3 lg:px-6 py-4 text-gray-900">{{ $word->translation }}</td>
                                <td class="px-3 lg:px-6 py-4 text-gray-600">{{ $word->group?->name ?? __('—') }}</td>
                                <td class="px-3 lg:px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <button wire:click="startEdit({{ $word->id }})" class="text-indigo-600 hover:text-indigo-900">{{ __('Redaktə et') }}</button>
                                    <button wire:click="delete({{ $word->id }})" wire:confirm="{{ __('Bu sözü silmək istədiyinizə əminsiniz?') }}" class="text-red-600 hover:text-red-900">{{ __('Sil') }}</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 lg:px-6 py-6 text-center text-gray-400">{{ trim($search) !== '' ? __('Heç nə tapılmadı.') : __('Hələ söz yoxdur.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sm:hidden bg-white shadow-sm divide-y divide-gray-100">
                @forelse ($words as $word)
                    <div wire:key="word-card-{{ $word->id }}" class="p-4 flex gap-3">
                        <button wire:click="toggleStar({{ $word->id }})" class="text-xl leading-none self-start {{ $word->is_starred ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-400' }}" title="{{ __('Ulduzla') }}">
                            {{ $word->is_starred ? '★' : '☆' }}
                        </button>
                        <div class="min-w-0 flex-1">
                            <div class="font-medium text-gray-900 break-words">{{ $word->original }} <button type="button" class="ml-1 text-gray-300 hover:text-indigo-600" data-text="{{ $word->original }}" onclick="window.speakItalian(this.dataset.text)">🔊</button></div>
                            @if ($word->pronunciation)
                                <div class="text-sm text-gray-500 break-words">[{{ $word->pronunciation }}]</div>
                            @endif
                            <div class="text-gray-900 break-words">{{ $word->translation }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $word->group?->name ?? __('—') }}</div>
                            <div class="flex gap-4 mt-2 text-sm">
                                <button wire:click="startEdit({{ $word->id }})" class="text-indigo-600 hover:text-indigo-900">{{ __('Redaktə et') }}</button>
                                <button wire:click="delete({{ $word->id }})" wire:confirm="{{ __('Bu sözü silmək istədiyinizə əminsiniz?') }}" class="text-red-600 hover:text-red-900">{{ __('Sil') }}</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-6 text-center text-gray-400 text-sm">{{ trim($search) !== '' ? __('Heç nə tapılmadı.') : __('Hələ söz yoxdur.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
