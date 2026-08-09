<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            {{ isset($title) ? $title . " - " . str_replace('_', ' ', config('app.name')) : str_replace('_', ' ', config('app.name')) }}
        </title>
        <link type="text/plain" rel="author" href="{{ asset('credits.txt') }}" />

        <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon" />


        <!-- Scripts -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
        <style>
            @import url('https://rsms.me/inter/inter.css');

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }

            /* Modern Sidebar & Navigation System */
            .navbar-vertical {
                background: #0f172a !important;
                border-right: 1px solid rgba(255, 255, 255, 0.07) !important;
            }

            .sidebar-brand-box {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(241, 245, 249, 0.9) 100%);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 1);
                border: 1px solid rgba(255, 255, 255, 0.8);
                transition: all 0.3s ease;
            }

            .sidebar-brand-box:hover {
                transform: translateY(-1px);
                box-shadow: 0 14px 28px -4px rgba(37, 99, 235, 0.25), inset 0 1px 0 rgba(255, 255, 255, 1);
            }

            .user-profile-card {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
                border: 1px solid rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(12px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .user-profile-card:hover {
                background: linear-gradient(135deg, rgba(37, 99, 235, 0.12) 0%, rgba(30, 58, 138, 0.2) 100%);
                border-color: rgba(59, 130, 246, 0.3);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.25);
            }

            .user-profile-card:hover .profile-arrow {
                opacity: 1 !important;
                color: #60a5fa !important;
                transform: translateX(4px);
                transition: all 0.2s ease;
            }

            .instansi-text-wrapper {
                position: relative;
                overflow: hidden;
                white-space: nowrap;
                max-width: 100%;
            }

            .user-profile-card:hover .instansi-marquee {
                display: inline-block;
                animation: marquee 8s linear infinite;
            }

            @keyframes marquee {
                0% { transform: translateX(0%); }
                15% { transform: translateX(0%); }
                85% { transform: translateX(-50%); }
                100% { transform: translateX(0%); }
            }

            /* Navigation Sidebar Menu Polish */
            .nav-section-title {
                font-size: 0.65rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                color: #64748b;
                padding: 1.25rem 1rem 0.4rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-section-title::after {
                content: '';
                flex-grow: 1;
                height: 1px;
                background: linear-gradient(90deg, rgba(100, 116, 139, 0.3) 0%, rgba(100, 116, 139, 0) 100%);
            }

            .navbar-dark .navbar-nav .nav-link {
                color: #94a3b8;
                border-radius: 10px;
                margin: 2px 8px;
                padding: 0.65rem 0.85rem;
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .navbar-dark .navbar-nav .nav-link:hover {
                color: #f8fafc;
                background: rgba(255, 255, 255, 0.06);
                transform: translateX(3px);
            }

            .nav-link.active {
                background: linear-gradient(135deg, rgba(37, 99, 235, 0.22) 0%, rgba(30, 58, 138, 0.35) 100%) !important;
                color: #60a5fa !important;
                border: 1px solid rgba(59, 130, 246, 0.35) !important;
                box-shadow: 0 4px 14px rgba(37, 99, 235, 0.2);
                font-weight: 600 !important;
            }

            .nav-link.active .nav-link-icon {
                color: #3b82f6 !important;
                filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.6));
            }

            .dropdown-item {
                color: #94a3b8 !important;
                border-radius: 8px;
                margin: 2px 12px;
                padding: 0.55rem 0.75rem;
                font-size: 0.85rem;
                transition: all 0.2s ease;
            }

            .dropdown-item:hover {
                color: #f8fafc !important;
                background: rgba(255, 255, 255, 0.06) !important;
                transform: translateX(3px);
            }

            .dropdown-item.active {
                background: linear-gradient(135deg, rgba(37, 99, 235, 0.25) 0%, rgba(29, 78, 216, 0.3) 100%) !important;
                color: #60a5fa !important;
                font-weight: 600 !important;
                border: 1px solid rgba(59, 130, 246, 0.3);
            }

            .menu-bullet-icon {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background-color: currentColor;
                opacity: 0.4;
                display: inline-block;
                margin-right: 10px;
                transition: all 0.25s ease;
            }

            .dropdown-item:hover .menu-bullet-icon,
            .dropdown-item.active .menu-bullet-icon {
                opacity: 1;
                transform: scale(1.5);
                background-color: #3b82f6;
                box-shadow: 0 0 8px rgba(59, 130, 246, 0.8);
            }

            .menu-badge-count {
                background: rgba(239, 68, 68, 0.2);
                color: #f87171;
                border: 1px solid rgba(239, 68, 68, 0.4);
                font-size: 0.675rem;
                padding: 0.15rem 0.45rem;
                border-radius: 20px;
                font-weight: 700;
            }
        </style>
        @PwaHead
    </head>

    <body class=" layout-fluid">
        <div class="page">
            <!-- Sidebar -->
            <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand sidebar-brand-box rounded-3 mx-3 my-3 p-2.5">
                        <a href="{{route('dashboard')}}" wire:navigate
                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none gap-2">
                            <img src="{{ asset('dist/img/logo.svg') }}" alt="Logo" class="navbar-brand-image"
                                style="height: 26px; filter: drop-shadow(0 2px 4px rgba(37,99,235,0.3));">
                            <span class="fw-extrabold text-slate-900 tracking-tight" style="font-size: 1.1rem; letter-spacing: -0.5px; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ str_replace('_', ' ', config('app.name')) }}</span>
                        </a>
                    </h1>
                    <div class="collapse navbar-collapse" id="sidebar-menu">
                        <ul class="navbar-nav pt-lg-3">
                            <li class="nav-item px-3 py-2">
                                <a href="{{ route('ubah-password')}}" wire:navigate class="text-decoration-none d-block position-relative overflow-hidden rounded-3 p-3 transition-all user-profile-card">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Avatar Box with Online Status -->
                                        <div class="position-relative flex-shrink-0">
                                            <div class="avatar avatar-md rounded-circle bg-primary-lt text-primary fw-bold shadow-sm border border-2 border-white-20" style="width: 42px; height: 42px; font-size: 1rem; background: linear-gradient(135deg, rgba(37,99,235,0.2) 0%, rgba(30,58,138,0.4) 100%);">
                                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(Auth()->user()->name, 0, 2)) }}
                                            </div>
                                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-dark rounded-circle" title="Aktif" style="transform: translate(2px, 2px);">
                                                <span class="visually-hidden">Online</span>
                                            </span>
                                        </div>

                                        <!-- User Info -->
                                        <div class="flex-grow-1 min-w-0">
                                            <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                <div class="fw-bold text-white text-truncate" style="font-size: 0.925rem; letter-spacing: -0.2px;" title="{{ Auth()->user()->name }}">
                                                    {{ Auth()->user()->name }}
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right text-muted opacity-50 flex-shrink-0 profile-arrow" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 6l6 6l-6 6" />
                                                </svg>
                                            </div>

                                            <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                                @php
                                                    $role = Auth()->user()->otorisasi;
                                                    $badgeClass = match($role) {
                                                        'admin' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: #ffffff;',
                                                        'bendahara' => 'background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff;',
                                                        'ppk' => 'background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: #ffffff;',
                                                        default => 'background: linear-gradient(135deg, #6b7280 0%, #374151 100%); color: #ffffff;'
                                                    };
                                                @endphp
                                                <span class="badge border-0 rounded-pill px-2 py-0.5 fw-semibold shadow-xs" style="font-size: 0.675rem; letter-spacing: 0.4px; {{ $badgeClass }}">
                                                    {{ \Illuminate\Support\Str::upper($role) }}
                                                </span>
                                            </div>

                                            @if (in_array(Auth()->user()->otorisasi, ['bendahara', 'ppk']) && Auth()->user()->name_instansi)
                                                @php
                                                    $instansiName = \Illuminate\Support\Str::headline(Auth()->user()->name_instansi);
                                                @endphp
                                                <div class="text-white-50 small mt-1 d-flex align-items-center instansi-text-wrapper" style="font-size: 0.75rem;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $instansiName }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building me-1 opacity-75 flex-shrink-0 text-info" width="13" height="13" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M3 21l18 0" />
                                                        <path d="M9 8l10 0" />
                                                        <path d="M9 12l10 0" />
                                                        <path d="M9 16l10 0" />
                                                        <path d="M4 21l0 -13a2 2 0 0 1 2 -2l12 0a2 2 0 0 1 2 2l0 13" />
                                                    </svg>
                                                    <span class="text-truncate instansi-marquee">{{ $instansiName }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <div class="nav-section-title">Utama</div>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard')}}" wire:navigate>
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v7a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>
                            </li>


                            <x-menu-otorisasi />
                            <li>
                                <hr class="m-2">
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a class="nav-link" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                <path d="M15 12h-12l3 -3" />
                                                <path d="M6 15l-3 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Logout
                                        </span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-bandage">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 12l0 .01" />
                                        <path d="M10 12l0 .01" />
                                        <path d="M12 10l0 .01" />
                                        <path d="M12 14l0 .01" />
                                        <path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" />
                                    </svg> {{ $title }}
                                </h2>
                            </div>
                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-deck row-cards">
                            {{ $slot }}
                        </div>
                    </div>
                </div>


                <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center flex-row-reverse">

                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">

                                        <a href="https://bpkad.tabalongkab.go.id/" target="_blank"
                                            class="link-secondary" style="text-decoration: underline">
                                            BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH KABUPATEN TABALONG</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>



        @stack('modals')


        <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
        <script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
        <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
        <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
        <!-- Tabler Core -->
        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
        {{-- @RegisterServiceWorkerScript --}}

        <div id="install-prompt" class="box-icon" style="display: none;">
            <span id="install-button" class="circle">
                <img src="{{ asset('install-app.png')}}" class="p-2" alt="Install App">
            </span>
        </div>
        <!-- PWA scripts -->
        <script src="{{ asset('sw.js')}}"></script>
        <script>
            if ("serviceWorker" in navigator) {
                navigator.serviceWorker.register("/sw.js").then(
                    (registration) => {
                        console.log("Service worker registration succeeded:");
                    },
                    (error) => {
                        console.log("Service worker registration failed", error);
                    }
                );
            } else {
                console.log("Service workers are not supported.");
            }
                let deferredPrompt;function showInstallPromotion(){document.getElementById("install-prompt").style.display="block"}window.addEventListener("load",(()=>{if(window.matchMedia("(display-mode: standalone)").matches){document.getElementById("install-prompt").style.display="none"}})),window.addEventListener("beforeinstallprompt",(e=>{e.preventDefault(),deferredPrompt=e,showInstallPromotion();document.getElementById("install-button").addEventListener("click",(()=>{deferredPrompt.prompt(),deferredPrompt.userChoice.then((e=>{deferredPrompt=null}))}))})),window.addEventListener("appinstalled",(()=>{document.getElementById("install-prompt").style.display="none"}));
        </script>
    </body>

</html>