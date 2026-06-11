@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "İstifadəçilər", "links" => [
        ["name" => "Home", "route" => "home"],
        ["name" => "İstifadəçilər", "route" => "users.index"],
    ]])

    <div class="container-fluid">
        <div class="w-full">
            
            {{-- Alerts --}}
            @if(session('success'))
                <div class="px-4 py-3 mb-4 text-sm text-success rounded-md bg-success/10 border-t-2 border-success flex justify-between items-center" id="success-alert">
                    <div>{{ session('success') }}</div>
                    <button type="button" onclick="document.getElementById('success-alert').remove()" class="text-success/50 hover:text-success focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="6"></line>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 py-3 mb-4 text-sm text-danger rounded-md bg-danger/10 border-t-2 border-danger flex justify-between items-center" id="error-alert">
                    <div>{{ session('error') }}</div>
                    <button type="button" onclick="document.getElementById('error-alert').remove()" class="text-danger/50 hover:text-danger focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="6"></line>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Stat Cards --}}
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 mb-6">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-default-500 font-semibold mb-1">Ümumi İstifadəçi</p>
                                <h4 class="text-default-800 font-bold text-2xl">{{ $totalUsers }}</h4>
                            </div>
                            <div class="flex items-center justify-center rounded-full size-12 bg-primary/10">
                                <i data-lucide="users" class="size-6 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-default-500 font-semibold mb-1">Administratorlar</p>
                                <h4 class="text-default-800 font-bold text-2xl">{{ $adminUsers }}</h4>
                            </div>
                            <div class="flex items-center justify-center rounded-full size-12 bg-warning/10">
                                <i data-lucide="shield-check" class="size-6 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-default-500 font-semibold mb-1">Adi İstifadəçilər</p>
                                <h4 class="text-default-800 font-bold text-2xl">{{ $regularUsers }}</h4>
                            </div>
                            <div class="flex items-center justify-center rounded-full size-12 bg-success/10">
                                <i data-lucide="user" class="size-6 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main List Card --}}
            <div class="card w-full">
                <div class="card-body">
                    
                    {{-- Search Form --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                        <h6 class="card-title">İstifadəçi Siyahısı</h6>
                        
                        <form method="GET" action="{{ route('users.index') }}" class="flex items-center gap-2 w-full sm:w-auto">
                            <div class="relative w-full sm:w-80">
                                <input type="text" name="search" value="{{ $search }}" class="form-input w-full ps-9 text-sm rounded-md border-default-200" placeholder="Axtar (ad, e-mail, istifadəçi adı)...">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                                    <i data-lucide="search" class="size-4 text-default-500"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-primary text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-primary/95">
                                Ara
                            </button>
                            @if($search)
                                <a href="{{ route('users.index') }}" class="btn bg-default-150 text-default-800 px-4 py-2 rounded-md text-sm font-semibold hover:bg-default-200">
                                    Təmizlə
                                </a>
                            @endif
                        </form>
                    </div>

                    {{-- Users Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        ID
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Ad / Soyad
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        İstifadəçi Adı
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        E-poçt
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Status
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Qeydiyyat Tarixi
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Əməliyyatlar
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $user)
                                <tr class="hover:bg-default-50/50">
                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14">
                                        <span class="text-primary font-semibold">#{{ $user->id }}</span>
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14 font-medium text-default-900">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14">
                                        {{ $user->username ?? '-' }}
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14">
                                        @if($user->is_admin)
                                            <span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-semibold bg-warning/10 text-warning border border-warning/30">
                                                Administrator
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-semibold bg-success/10 text-success border border-success/30">
                                                İstifadəçi
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14 text-sm text-default-500">
                                        {{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : '-' }}
                                    </td>

                                    <td class="px-3.5 py-3 border-b border-default-200 dark:border-white/14 font-semibold">
                                        <div class="flex items-center gap-3">
                                            {{-- Toggle Admin Button --}}
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.toggle-admin', $user->id) }}" method="POST" onsubmit="return confirm('İstifadəçinin rolunu dəyişmək istədiyinizdən əminsiniz?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm border border-default-200 hover:bg-default-100 px-2.5 py-1.5 rounded-md text-xs font-semibold text-default-700 flex items-center gap-1" title="Rolunu dəyiş">
                                                        <i data-lucide="shield" class="size-3.5"></i>
                                                        {{ $user->is_admin ? 'Adminlikdən Çıxar' : 'Admin Et' }}
                                                    </button>
                                                </form>

                                                {{-- Delete Button --}}
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu istifadəçini silmək istədiyinizdən əminsiniz? Bu əməliyyat geri alına bilməz!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm border border-danger/25 text-danger hover:bg-danger/10 px-2.5 py-1.5 rounded-md text-xs font-semibold flex items-center gap-1" title="Sil">
                                                        <i data-lucide="trash-2" class="size-3.5"></i>
                                                        Sil
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-default-400 italic">Cari Hesab</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-3.5 py-8 text-center text-default-500">
                                        Axtarışa uyğun heç bir istifadəçi tapılmadı.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($users->hasPages())
                        <div class="mt-6">
                            {{ $users->links('vendor.pagination.default') }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
