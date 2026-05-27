@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Günün Sözü", "links" => [
        ["name" => "Home", "route" => "home"],
        ["name" => "Günün Sözü", "route" => "word-of-day.index"],
    ]])

    <div class="container-fluid">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ── Form ────────────────────────────────────────────── --}}
            <div class="xl:col-span-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Günün Sözünü Təyin Et</h5>

                        @if(session('success'))
                            <div class="alert alert-success mb-4">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('word-of-day.store') }}" method="POST" id="wod-form">
                            @csrf

                            {{-- Date --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Tarix</label>
                                <input type="date" name="date"
                                    value="{{ old('date', now()->format('Y-m-d')) }}"
                                    class="form-input w-full" required>
                                @error('date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Search --}}
                            <div class="mb-4 relative">
                                <label class="block text-sm font-medium mb-1">Söz axtar</label>
                                <input type="text" id="word-search"
                                    placeholder="Söz və ya tərcümə ilə axtar..."
                                    class="form-input w-full"
                                    autocomplete="off">

                                {{-- Dropdown --}}
                                <div id="search-dropdown"
                                    class="absolute z-50 w-full bg-white border border-default-200 rounded-lg shadow-lg mt-1 hidden max-h-60 overflow-y-auto">
                                </div>
                            </div>

                            {{-- Selected word preview --}}
                            <div id="selected-preview" class="hidden mb-4 p-3 bg-primary/5 border border-primary/20 rounded-lg">
                                <p class="text-xs text-default-500 mb-1">Seçilmiş söz:</p>
                                <p class="font-semibold text-default-800" id="preview-word"></p>
                                <p class="text-sm text-default-500" id="preview-translation"></p>
                            </div>

                            <input type="hidden" name="dictionary_id" id="dictionary-id">
                            @error('dictionary_id')
                                <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                            @enderror

                            <button type="submit"
                                class="btn bg-primary text-white w-full"
                                id="submit-btn" disabled>
                                Təyin Et
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── Table ───────────────────────────────────────────── --}}
            <div class="xl:col-span-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Günün Sözləri</h5>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="text-left">
                                    <tr>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-default-200">Tarix</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-default-200">Söz</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-default-200">Tərcümə</th>
                                        <th class="px-3.5 py-2.5 font-semibold border-b border-default-200">Əməliyyat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($words as $item)
                                    <tr>
                                        <td class="px-3.5 py-2.5 border-y border-default-200">
                                            <span class="@if($item->date->isToday()) text-primary font-semibold @endif">
                                                {{ $item->date->format('d.m.Y') }}
                                                @if($item->date->isToday())
                                                    <span class="text-xs bg-primary/10 text-primary px-1.5 py-0.5 rounded ml-1">Bu gün</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 font-medium">
                                            {{ $item->dictionary->word ?? '-' }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200 text-default-500 text-sm">
                                            {{ $item->dictionary->translation ?? '-' }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-default-200">
                                            @include('layout.includes.ui._delete_button', [
                                                'route' => 'word-of-day.destroy',
                                                'id'    => $item->id,
                                            ])
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-3.5 py-6 text-center text-default-400 border-y border-default-200">
                                            Hələ günün sözü təyin edilməyib
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $words->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
    const searchInput   = document.getElementById('word-search');
    const dropdown      = document.getElementById('search-dropdown');
    const dictIdInput   = document.getElementById('dictionary-id');
    const preview       = document.getElementById('selected-preview');
    const previewWord   = document.getElementById('preview-word');
    const previewTrans  = document.getElementById('preview-translation');
    const submitBtn     = document.getElementById('submit-btn');

    let debounceTimer;

    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        const q = searchInput.value.trim();
        if (q.length < 1) { dropdown.classList.add('hidden'); return; }

        debounceTimer = setTimeout(() => {
            fetch(`{{ route('word-of-day.search') }}?q=${encodeURIComponent(q)}`)
                .then(r => r.json())
                .then(data => {
                    dropdown.innerHTML = '';
                    if (!data.length) {
                        dropdown.innerHTML = '<div class="px-4 py-3 text-sm text-default-400">Söz tapılmadı</div>';
                    } else {
                        data.forEach(item => {
                            const el = document.createElement('div');
                            el.className = 'px-4 py-2.5 cursor-pointer hover:bg-primary/5 border-b border-default-100 last:border-0';
                            el.innerHTML = `<p class="font-medium text-sm text-default-800">${item.word}</p>
                                            <p class="text-xs text-default-400">${item.translation}</p>`;
                            el.addEventListener('click', () => selectWord(item));
                            dropdown.appendChild(el);
                        });
                    }
                    dropdown.classList.remove('hidden');
                });
        }, 300);
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    function selectWord(item) {
        dictIdInput.value       = item.id;
        searchInput.value       = item.word;
        previewWord.textContent = item.word;
        previewTrans.textContent = item.translation;
        preview.classList.remove('hidden');
        dropdown.classList.add('hidden');
        submitBtn.disabled = false;
    }
</script>
@endpush
