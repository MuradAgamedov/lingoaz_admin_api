@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "APK Buraxılışları", "links" => [
        ["name" => "Home",            "route" => "home"],
        ["name" => "APK Buraxılışları", "route" => "apk.index"],
    ]])

    <div class="container-fluid">
        <div class="w-full">

            @if(session('success'))
                <div class="px-4 py-3 mb-4 text-sm text-success rounded-md bg-success/10 border-t-2 border-success flex justify-between items-center" id="s-alert">
                    <div>{{ session('success') }}</div>
                    <button onclick="document.getElementById('s-alert').remove()" class="text-success/50 hover:text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="px-4 py-3 mb-4 text-sm text-danger rounded-md bg-danger/10 border-t-2 border-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid lg:grid-cols-3 grid-cols-1 gap-6 mb-6">

                {{-- Upload form --}}
                <div class="card lg:col-span-1">
                    <div class="card-header">
                        <h6 class="card-title">Yeni APK yüklə</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('apk.store') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-default-700 mb-1.5">Versiya</label>
                                <input type="text" name="version" value="{{ old('version') }}"
                                    placeholder="məs: 1.0.1"
                                    class="form-input w-full" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-default-700 mb-1.5">APK fayl</label>
                                <input type="file" name="apk" accept=".apk"
                                    class="block w-full text-sm text-default-500
                                           file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                           file:text-sm file:font-semibold file:bg-primary/10 file:text-primary
                                           hover:file:bg-primary/20 cursor-pointer" required>
                                <p class="text-xs text-default-400 mt-1.5">Maksimum 200 MB · yalnız .apk</p>
                            </div>
                            <button type="submit" class="btn bg-primary text-white w-full">
                                <i data-lucide="upload" class="size-4 me-1.5"></i>
                                Yüklə
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Releases table --}}
                <div class="card lg:col-span-2">
                    <div class="card-header">
                        <h6 class="card-title">Buraxılışlar</h6>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-default-200">
                                <thead class="bg-default-150">
                                    <tr class="text-sm font-normal text-default-500 whitespace-nowrap">
                                        <th class="px-3.5 py-3 text-start">Versiya</th>
                                        <th class="px-3.5 py-3 text-start">Fayl</th>
                                        <th class="px-3.5 py-3 text-start">Ölçü</th>
                                        <th class="px-3.5 py-3 text-start">Status</th>
                                        <th class="px-3.5 py-3 text-start">Tarix</th>
                                        <th class="px-3.5 py-3 text-start">Əməliyyat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-default-200">
                                    @forelse($releases as $release)
                                        <tr class="text-default-800 font-normal">
                                            <td class="px-3.5 py-2.5 text-sm font-semibold whitespace-nowrap">
                                                v{{ $release->version }}
                                            </td>
                                            <td class="px-3.5 py-2.5 text-sm text-default-500 whitespace-nowrap">
                                                {{ $release->filename }}
                                            </td>
                                            <td class="px-3.5 py-2.5 text-sm whitespace-nowrap">
                                                {{ $release->getSizeLabel() }}
                                            </td>
                                            <td class="px-3.5 py-2.5 whitespace-nowrap">
                                                @if($release->is_active)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">
                                                        ✓ Aktiv
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-default-100 text-default-500">
                                                        Deaktiv
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-3.5 py-2.5 text-sm text-default-500 whitespace-nowrap">
                                                {{ $release->created_at->format('d.m.Y') }}
                                            </td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    @unless($release->is_active)
                                                        <form method="POST" action="{{ route('apk.activate', $release->id) }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm bg-primary/10 text-primary hover:bg-primary hover:text-white">
                                                                Aktiv et
                                                            </button>
                                                        </form>
                                                    @endunless
                                                    <a href="{{ Storage::url($release->path) }}" download
                                                        class="btn btn-sm bg-default-100 text-default-600 hover:bg-default-200">
                                                        <i data-lucide="download" class="size-3.5"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('apk.destroy', $release->id) }}"
                                                        onsubmit="return confirm('Bu APK-nı silmək istəyirsiniz?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm bg-danger/10 text-danger hover:bg-danger hover:text-white">
                                                            <i data-lucide="trash-2" class="size-3.5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-3.5 py-8 text-center text-default-400 text-sm">
                                                Hələ heç bir APK yüklənməyib.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
@endsection
