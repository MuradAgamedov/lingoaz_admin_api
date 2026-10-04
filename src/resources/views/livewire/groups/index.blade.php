<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Qruplar') }}</h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-0 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">

            @if ($showForm)
                <div class="bg-white p-4 sm:p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ $editingId ? __('Qrupu redaktə et') : __('Yeni qrup') }}
                    </h3>

                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <x-input-label for="name" :value="__('Qrup adı')" />
                            <x-text-input wire:model="name" id="name" type="text" class="mt-1 block w-full" autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button type="submit">{{ __('Yadda saxla') }}</x-primary-button>
                            <x-secondary-button type="button" wire:click="cancel">{{ __('Ləğv et') }}</x-secondary-button>
                        </div>
                    </form>
                </div>
            @else
                <div class="px-4 sm:px-0">
                    <x-primary-button type="button" wire:click="startCreate">{{ __('+ Yeni qrup') }}</x-primary-button>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-3 sm:px-6 py-3">{{ __('Ad') }}</th>
                            <th class="px-3 sm:px-6 py-3">{{ __('Söz sayı') }}</th>
                            <th class="px-3 sm:px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($groups as $group)
                            <tr wire:key="group-{{ $group->id }}">
                                <td class="px-3 sm:px-6 py-4 text-gray-900">{{ $group->name }}</td>
                                <td class="px-3 sm:px-6 py-4 text-gray-600">{{ __(':count söz', ['count' => $group->words_count]) }}</td>
                                <td class="px-3 sm:px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <button wire:click="startEdit({{ $group->id }})" class="text-indigo-600 hover:text-indigo-900">{{ __('Redaktə et') }}</button>
                                    <button wire:click="delete({{ $group->id }})" wire:confirm="{{ __('Bu qrupu silmək istədiyinizə əminsiniz? Qrupdakı sözlər silinmir.') }}" class="text-red-600 hover:text-red-900">{{ __('Sil') }}</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 sm:px-6 py-6 text-center text-gray-400">{{ __('Hələ qrup yoxdur.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
