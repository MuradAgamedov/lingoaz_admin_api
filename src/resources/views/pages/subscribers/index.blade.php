@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Abunəçilər", "links" => [
        ["name" => "Home", "route" => "home"],
        ["name" => "Abunəçilər", "route" => "subscribers.index"],
    ]])

    <div class="container-fluid">
        <div class="w-full">

            @if(session('success'))
                <div class="px-4 py-3 mb-4 text-sm text-success rounded-md bg-success/10 border-t-2 border-success flex justify-between items-center" id="success-alert">
                    <div>{{ session('success') }}</div>
                    <button type="button" onclick="document.getElementById('success-alert').remove()" class="text-success/50 hover:text-success focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            @endif

            {{-- Stat --}}
            <div class="grid grid-cols-1 gap-5 mb-6 max-w-xs">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-default-500 font-semibold mb-1">Ümumi Abunəçi</p>
                                <h4 class="text-default-800 font-bold text-2xl">{{ $total }}</h4>
                            </div>
                            <div class="flex items-center justify-center rounded-full size-12 bg-primary/10">
                                <i data-lucide="mail" class="size-6 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="card">
                <div class="card-header flex flex-wrap gap-3 items-center justify-between">
                    <h6 class="card-title">E-poçt abunəçiləri</h6>
                    <form method="GET" action="{{ route('subscribers.index') }}" class="flex gap-2">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search }}"
                                placeholder="E-poçt axtar..."
                                class="form-input form-input-sm ps-9">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                                <i data-lucide="search" class="size-3.5 text-default-500"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm bg-primary text-white">Axtar</button>
                        @if($search)
                            <a href="{{ route('subscribers.index') }}" class="btn btn-sm bg-default-200 text-default-600">Sıfırla</a>
                        @endif
                    </form>
                </div>

                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-500 whitespace-nowrap">
                                            <th class="px-3.5 py-3 text-start">#</th>
                                            <th class="px-3.5 py-3 text-start">E-poçt</th>
                                            <th class="px-3.5 py-3 text-start">Platforma</th>
                                            <th class="px-3.5 py-3 text-start">Tarix</th>
                                            <th class="px-3.5 py-3 text-start">Əməliyyat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        @forelse($subscribers as $i => $sub)
                                            <tr class="text-default-800 font-normal">
                                                <td class="px-3.5 py-2.5 text-sm whitespace-nowrap">
                                                    {{ $subscribers->firstItem() + $i }}
                                                </td>
                                                <td class="px-3.5 py-2.5 text-sm">{{ $sub->email }}</td>
                                                <td class="px-3.5 py-2.5 text-sm whitespace-nowrap">
                                                    @if($sub->store === 'appstore')
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-medium bg-default-100 text-default-700">
                                                            🍎 App Store
                                                        </span>
                                                    @elseif($sub->store === 'googleplay')
                                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-medium bg-default-100 text-default-700">
                                                            ▶️ Google Play
                                                        </span>
                                                    @else
                                                        <span class="text-default-400">—</span>
                                                    @endif
                                                </td>
                                                <td class="px-3.5 py-2.5 text-sm whitespace-nowrap text-default-500">
                                                    {{ $sub->created_at->format('d.m.Y H:i') }}
                                                </td>
                                                <td class="px-3.5 py-2.5">
                                                    <form method="POST" action="{{ route('subscribers.destroy', $sub->id) }}"
                                                        onsubmit="return confirm('Bu abunəçini silmək istəyirsiniz?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm bg-danger/10 text-danger hover:bg-danger hover:text-white">
                                                            <i data-lucide="trash-2" class="size-3.5"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-3.5 py-8 text-center text-default-400 text-sm">
                                                    Heç bir abunəçi tapılmadı.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if($subscribers->hasPages())
                    <div class="card-footer flex items-center justify-between flex-wrap gap-3">
                        <p class="text-default-500 text-sm">
                            {{ $subscribers->firstItem() }}–{{ $subscribers->lastItem() }} / {{ $subscribers->total() }} nəticə
                        </p>
                        {{ $subscribers->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</main>
@endsection
