<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="utf-8">
    <title>LingoAz | Azərbaycan dili öyrənmə platforması</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LingoAz — Azərbaycan dilini öyrənmək üçün ən yaxşı mobil tətbiq. Şəxsi lüğət, cümlə lüğəti, söz öyrənmə və daha çox.">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <script>
        (function () {
            const html = document.documentElement;
            const storageKey = "__TAILWICK_CONFIG__";
            const savedConfig = sessionStorage.getItem(storageKey);
            const defaultConfig = { dir: "ltr", theme: "light", sidenav: { color: "light", size: "default" } };
            function getSystemTheme() {
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? "dark" : "light";
            }
            const htmlConfig = {
                dir: html.getAttribute("dir") || defaultConfig.dir,
                theme: html.getAttribute("data-theme") === 'system' ? getSystemTheme() : html.getAttribute("data-theme") || defaultConfig.theme,
                sidenav: { color: html.getAttribute("data-sidenav-color") || defaultConfig.sidenav.color, size: html.getAttribute("data-sidenav-size") || defaultConfig.sidenav.size },
            };
            window.defaultConfig = structuredClone(htmlConfig);
            let config = savedConfig ? JSON.parse(savedConfig) : htmlConfig;
            window.config = config;
            html.setAttribute("dir", config.dir);
            html.setAttribute("data-theme", config.theme);
            html.setAttribute("data-sidenav-color", config.sidenav.color);
        })();
    </script>

    <script type="module" crossorigin src="{{ asset('assets/index-DsDs3XAz.js') }}"></script>
    <link rel="modulepreload" crossorigin href="{{ asset('assets/app-BxTRRtUp.js') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/app-0ZOPNGSF.css') }}">
</head>

<body>
<div class="relative min-h-screen w-full flex flex-col justify-center items-center overflow-hidden">

    {{-- Arxa fon naxışı --}}
    <div class="absolute inset-0 overflow-hidden -z-10">
        <svg aria-hidden="true" class="absolute inset-0 size-full fill-black/2 stroke-black/5 dark:fill-white/2.5 dark:stroke-white/2.5">
            <defs>
                <pattern id="welcomePattern" width="56" height="56" patternUnits="userSpaceOnUse" x="50%" y="16">
                    <path d="M.5 56V.5H72" fill="none"></path>
                </pattern>
            </defs>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#welcomePattern)"></rect>
        </svg>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-primary/10 blur-3xl"></div>
    </div>

    {{-- Kart --}}
    <div class="card md:w-2xl w-screen z-10 mx-4">
        <div class="text-center px-10 py-14">

            {{-- Logo --}}
            <div class="flex justify-center mb-8">
                <img src="{{ asset('assets/logo-dark-BRT9tiBX.png') }}" alt="LingoAz" class="h-8 flex dark:hidden">
                <img src="{{ asset('assets/logo-light-CCjoJosn.png') }}" alt="LingoAz" class="h-8 hidden dark:flex">
            </div>

            {{-- Başlıq --}}
            <h1 class="text-3xl font-bold text-default-900 mb-3">Dili öyrən, dünyaya açıl</h1>
            <p class="text-default-500 text-base mb-10 max-w-md mx-auto">
                LingoAz ilə şəxsi lüğətinizi qurun, söz öyrənin, cümlə lüğətindən istifadə edin
                və qeydlərinizi bir yerdə saxlayın.
            </p>

            {{-- Xüsusiyyətlər --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-primary/5">
                    <div class="flex items-center justify-center size-10 rounded-full bg-primary/10">
                        <i data-lucide="book-open" class="size-5 text-primary"></i>
                    </div>
                    <span class="text-xs font-medium text-default-700 text-center">Şəxsi Lüğət</span>
                </div>
                <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-success/5">
                    <div class="flex items-center justify-center size-10 rounded-full bg-success/10">
                        <i data-lucide="graduation-cap" class="size-5 text-success"></i>
                    </div>
                    <span class="text-xs font-medium text-default-700 text-center">Söz Öyrən</span>
                </div>
                <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-info/5">
                    <div class="flex items-center justify-center size-10 rounded-full bg-info/10">
                        <i data-lucide="message-square" class="size-5 text-info"></i>
                    </div>
                    <span class="text-xs font-medium text-default-700 text-center">Cümlə Lüğəti</span>
                </div>
                <div class="flex flex-col items-center gap-2 p-4 rounded-xl bg-warning/5">
                    <div class="flex items-center justify-center size-10 rounded-full bg-warning/10">
                        <i data-lucide="notebook-pen" class="size-5 text-warning"></i>
                    </div>
                    <span class="text-xs font-medium text-default-700 text-center">Qeydlər</span>
                </div>
            </div>

            {{-- Düymə --}}
            <a href="{{ route('login') }}" class="btn bg-primary text-white px-10 py-2.5 text-sm font-semibold">
                <i data-lucide="log-in" class="size-4 me-2 inline-block"></i>
                Daxil ol
            </a>

        </div>
    </div>

    {{-- Alt mətn --}}
    <p class="mt-6 text-xs text-default-400 z-10">© {{ date('Y') }} LingoAz. Bütün hüquqlar qorunur.</p>
</div>
</body>
</html>
