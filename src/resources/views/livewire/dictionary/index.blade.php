<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Lüğət') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($showForm)
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
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

                        <div>
                            <x-input-label for="translation" :value="__('Tərcümə')" />
                            <x-text-input wire:model="translation" id="translation" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('translation')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="groupId" :value="__('Qrup')" />

                            <div class="flex items-center gap-3 mt-1">
                                <select wire:model="groupId" id="groupId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
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
            @else
                <div>
                    <x-primary-button type="button" wire:click="startCreate">{{ __('+ Yeni söz əlavə et') }}</x-primary-button>
                </div>
            @endif

            <div class="flex items-center gap-3">
                <x-input-label for="filterGroupId" :value="__('Qrupa görə filtrlə:')" />
                <select wire:model.live="filterGroupId" id="filterGroupId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3"></th>
                            <th class="px-6 py-3">{{ __('Orijinal söz') }}</th>
                            <th class="px-6 py-3">{{ __('Oxunuşu') }}</th>
                            <th class="px-6 py-3">{{ __('Tərcümə') }}</th>
                            <th class="px-6 py-3">{{ __('Qrup') }}</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($words as $word)
                            <tr wire:key="word-{{ $word->id }}">
                                <td class="px-6 py-4">
                                    <button wire:click="toggleStar({{ $word->id }})" class="text-lg {{ $word->is_starred ? 'text-yellow-400' : 'text-gray-300 hover:text-gray-400' }}" title="{{ __('Ulduzla') }}">
                                        {{ $word->is_starred ? '★' : '☆' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-gray-900">{{ $word->original }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $word->pronunciation }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $word->translation }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $word->group?->name ?? __('—') }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="startEdit({{ $word->id }})" class="text-indigo-600 hover:text-indigo-900">{{ __('Redaktə et') }}</button>
                                    <button wire:click="delete({{ $word->id }})" wire:confirm="{{ __('Bu sözü silmək istədiyinizə əminsiniz?') }}" class="text-red-600 hover:text-red-900">{{ __('Sil') }}</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-6 text-center text-gray-400">{{ __('Hələ söz yoxdur.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
