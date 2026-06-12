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
                        <form id="apkForm" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-default-700 mb-1.5">Versiya</label>
                                <input type="text" id="versionInput" name="version"
                                    placeholder="məs: 1.0.1"
                                    class="form-input w-full" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-default-700 mb-1.5">APK fayl</label>
                                <input type="file" id="apkInput" name="apk" accept=".apk"
                                    class="block w-full text-sm text-default-500
                                           file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                           file:text-sm file:font-semibold file:bg-primary/10 file:text-primary
                                           hover:file:bg-primary/20 cursor-pointer" required>
                                <p class="text-xs text-default-400 mt-1.5">Maksimum 200 MB · yalnız .apk</p>
                            </div>

                            {{-- Progress panel --}}
                            <div id="uploadProgress" class="hidden flex flex-col gap-2">
                                <div class="flex items-center justify-between text-sm mb-0.5">
                                    <span id="progressLabel" class="text-default-600 font-medium">Yüklənir...</span>
                                    <span id="progressPercent" class="font-bold text-primary">0%</span>
                                </div>
                                <div class="w-full h-3 rounded-full bg-default-200 overflow-hidden">
                                    <div id="progressBar"
                                        class="h-3 rounded-full bg-primary transition-all duration-200"
                                        style="width:0%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-default-400 mt-0.5">
                                    <span id="progressUploaded">0 MB / 0 MB</span>
                                    <span id="progressSpeed">— MB/s</span>
                                </div>
                            </div>

                            {{-- Success state --}}
                            <div id="uploadDone" class="hidden items-center gap-2 text-success text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                APK uğurla yükləndi, yönləndirilir...
                            </div>

                            {{-- Error state --}}
                            <div id="uploadError" class="hidden text-danger text-sm"></div>

                            <button type="submit" id="uploadBtn" class="btn bg-primary text-white w-full">
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

<script>
document.getElementById('apkForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const versionInput = document.getElementById('versionInput');
    const apkInput     = document.getElementById('apkInput');
    const file         = apkInput.files[0];

    if (!versionInput.value.trim() || !file) return;

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('version', versionInput.value.trim());
    formData.append('apk', file);

    // UI state — yükləmə başlayır
    document.getElementById('uploadBtn').disabled    = true;
    document.getElementById('uploadBtn').innerHTML   = '<span class="opacity-50">Yüklənir...</span>';
    document.getElementById('uploadProgress').classList.remove('hidden');
    document.getElementById('uploadError').classList.add('hidden');
    document.getElementById('uploadDone').classList.add('hidden');

    const totalMB   = file.size / (1024 * 1024);
    let   startTime = Date.now();

    const xhr = new XMLHttpRequest();

    xhr.upload.addEventListener('progress', function(e) {
        if (!e.lengthComputable) return;

        const pct        = Math.round((e.loaded / e.total) * 100);
        const loadedMB   = (e.loaded / (1024 * 1024)).toFixed(1);
        const elapsed    = (Date.now() - startTime) / 1000;
        const speedMBs   = elapsed > 0 ? (e.loaded / (1024 * 1024) / elapsed).toFixed(1) : '—';

        document.getElementById('progressBar').style.width     = pct + '%';
        document.getElementById('progressPercent').textContent = pct + '%';
        document.getElementById('progressLabel').textContent   = pct < 100 ? 'Yüklənir...' : 'Server emal edir...';
        document.getElementById('progressUploaded').textContent = loadedMB + ' MB / ' + totalMB.toFixed(1) + ' MB';
        document.getElementById('progressSpeed').textContent   = speedMBs + ' MB/s';
    });

    xhr.addEventListener('load', function() {
        if (xhr.status === 200 || xhr.status === 302) {
            document.getElementById('progressBar').style.width     = '100%';
            document.getElementById('progressPercent').textContent = '100%';
            document.getElementById('uploadProgress').classList.add('hidden');
            document.getElementById('uploadDone').classList.remove('hidden');
            document.getElementById('uploadDone').classList.add('flex');
            setTimeout(() => { window.location.href = '{{ route("apk.index") }}?success=1'; }, 800);
        } else {
            showError('Xəta baş verdi (HTTP ' + xhr.status + '). Yenidən cəhd edin.');
        }
    });

    xhr.addEventListener('error', function() {
        showError('Şəbəkə xətası. Yenidən cəhd edin.');
    });

    function showError(msg) {
        document.getElementById('uploadProgress').classList.add('hidden');
        document.getElementById('uploadError').textContent = msg;
        document.getElementById('uploadError').classList.remove('hidden');
        document.getElementById('uploadBtn').disabled  = false;
        document.getElementById('uploadBtn').innerHTML = '<i data-lucide="upload" class="size-4 me-1.5"></i>Yüklə';
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    xhr.open('POST', '{{ route("apk.store") }}');
    xhr.send(formData);
});

// ?success=1 ilə geri gəlirsə alert göstər
if (new URLSearchParams(window.location.search).get('success')) {
    const el = document.createElement('div');
    el.id = 's-alert';
    el.className = 'px-4 py-3 mb-4 text-sm text-success rounded-md bg-success/10 border-t-2 border-success flex justify-between items-center';
    el.innerHTML = '<div>APK uğurla yükləndi.</div><button onclick="this.parentElement.remove()" class="text-success/50 hover:text-success">✕</button>';
    document.querySelector('.container-fluid .w-full').prepend(el);
    history.replaceState(null, '', window.location.pathname);
}
</script>
@endsection
