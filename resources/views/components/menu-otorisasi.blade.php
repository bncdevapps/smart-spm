<div>
    @if (Auth()->user()->otorisasi === 'admin')
        <!-- VERIFIKASI SPM -->
        <div class="nav-section-title">Verifikasi SPM</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('daftar-spm-review', 3).'*') ? 'active' : '' }}" href="{{ route('daftar-spm-review',3)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
                </span>
                <span class="nav-link-title">Belum Diverifikasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('daftar-spm-review', 4).'*') ? 'active' : '' }}" href="{{ route('daftar-spm-review',4)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                </span>
                <span class="nav-link-title">Sudah Diverifikasi</span>
            </a>
        </li>

        <!-- LAPORAN -->
        <div class="nav-section-title">Laporan</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('lembar-penguji') ? 'active' : '' }}" href="{{ route('lembar-penguji')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-analytics"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17l0 -5" /><path d="M12 17l0 -1" /><path d="M15 17l0 -3" /></svg>
                </span>
                <span class="nav-link-title">Lembar Penguji</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('laporan-spm', 1).'*') ? 'active' : '' }}" href="{{ route('laporan-spm',1)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-report-medical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M10 14l4 0" /><path d="M12 12l0 4" /></svg>
                </span>
                <span class="nav-link-title">Register SPM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('laporan-spm', 2).'*') ? 'active' : '' }}" href="{{ route('laporan-spm',2)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-receipt-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><path d="M14 8h-4" /><path d="M14 12h-4" /><path d="M14 16h-4" /></svg>
                </span>
                <span class="nav-link-title">Register SP2D</span>
            </a>
        </li>

        <!-- MASTER DATA & PENGATURAN -->
        <div class="nav-section-title">Master Data</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pajak') ? 'active' : '' }}" href="{{route('pajak')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-percentage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M7 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M6 18l12 -12" /></svg>
                </span>
                <span class="nav-link-title">Pajak</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('potongan') ? 'active' : '' }}" href="{{route('potongan')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-scissors"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.6 8.6l10.4 10.4" /><path d="M8.6 15.4l10.4 -10.4" /></svg>
                </span>
                <span class="nav-link-title">Potongan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('daftar-instansi') ? 'active' : '' }}" href="{{route('daftar-instansi')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-building-community"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l8 0" /><path d="M8 13l8 0" /><path d="M8 17l8 0" /><path d="M4 21l0 -13a2 2 0 0 1 2 -2l12 0a2 2 0 0 1 2 2l0 13" /><path d="M12 3l0 2" /></svg>
                </span>
                <span class="nav-link-title">Daftar Instansi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('jenis-spm') ? 'active' : '' }}" href="{{route('jenis-spm')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-category"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6z" /><path d="M14 4h6v6h-6z" /><path d="M4 14h6v6h-6z" /><path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>
                </span>
                <span class="nav-link-title">Jenis SPM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('daftar-pengguna') ? 'active' : '' }}" href="{{route('daftar-pengguna')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                </span>
                <span class="nav-link-title">Daftar Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('penyedia') ? 'active' : '' }}" href="{{route('penyedia')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-briefcase"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                </span>
                <span class="nav-link-title">Penyedia / Rekanan</span>
            </a>
        </li>

        <div class="nav-section-title">Akun</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ubah-password') ? 'active' : '' }}" href="{{ route('ubah-password')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-1.751 .154a1 1 0 0 1 -1.086 -1.086l.154 -1.751a2 2 0 0 1 .578 -1.239l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /></svg>
                </span>
                <span class="nav-link-title">Ubah Password</span>
            </a>
        </li>

    @elseif (Auth()->user()->otorisasi === 'ppk')
        <div class="nav-section-title">Transaksi SPM</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('daftar-spm-review') ? 'active' : '' }}" href="{{ route('daftar-spm-review',0)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>
                </span>
                <span class="nav-link-title">Daftar SPM</span>
            </a>
        </li>

        <div class="nav-section-title">Akun</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ubah-password') ? 'active' : '' }}" href="{{ route('ubah-password')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-1.751 .154a1 1 0 0 1 -1.086 -1.086l.154 -1.751a2 2 0 0 1 .578 -1.239l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /></svg>
                </span>
                <span class="nav-link-title">Ubah Password</span>
            </a>
        </li>

    @elseif (Auth()->user()->otorisasi === 'bendahara')
        <div class="nav-section-title">Transaksi SPM</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('daftar-spm') ? 'active' : '' }}" href="{{ route('daftar-spm')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                </span>
                <span class="nav-link-title">Daftar SPM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('status-spm') ? 'active' : '' }}" href="{{ route('status-spm')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-info"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M11 14h1v4h1" /><path d="M12 11h.01" /></svg>
                </span>
                <span class="nav-link-title">Status SPM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('daftar-spm-review', 5).'*') ? 'active' : '' }}" href="{{ route('daftar-spm-review',5)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-list-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.5 5.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 11.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 17.5l1.5 1.5l2.5 -2.5" /><path d="M11 6l9 0" /><path d="M11 12l9 0" /><path d="M11 18l9 0" /></svg>
                </span>
                <span class="nav-link-title">Daftar SP2D</span>
            </a>
        </li>

        <div class="nav-section-title">Laporan</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('laporan-spm', 1).'*') ? 'active' : '' }}" href="{{ route('laporan-spm',1)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-report-medical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M10 14l4 0" /><path d="M12 12l0 4" /></svg>
                </span>
                <span class="nav-link-title">Register SPM</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('laporan-spm', 2).'*') ? 'active' : '' }}" href="{{ route('laporan-spm',2)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-receipt-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><path d="M14 8h-4" /><path d="M14 12h-4" /><path d="M14 16h-4" /></svg>
                </span>
                <span class="nav-link-title">Register SP2D</span>
            </a>
        </li>

        <div class="nav-section-title">Master Data</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('penyedia') ? 'active' : '' }}" href="{{ route('penyedia')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-briefcase"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M12 12l0 .01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                </span>
                <span class="nav-link-title">Penyedia / Rekanan</span>
            </a>
        </li>

        <div class="nav-section-title">Akun</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ubah-password') ? 'active' : '' }}" href="{{ route('ubah-password')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-1.751 .154a1 1 0 0 1 -1.086 -1.086l.154 -1.751a2 2 0 0 1 .578 -1.239l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /></svg>
                </span>
                <span class="nav-link-title">Ubah Password</span>
            </a>
        </li>

    @elseif (Auth()->user()->otorisasi === 'verifikator')
        <div class="nav-section-title">Verifikasi SPM</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('daftar-spm-review', 1).'*') ? 'active' : '' }}" href="{{ route('daftar-spm-review',1)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-clock-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.942 13.021a9 9 0 1 0 -9.407 7.967" /><path d="M12 7v5l3 3" /><path d="M15 19l2 2l4 -4" /></svg>
                </span>
                <span class="nav-link-title">Perlu Verifikasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->fullUrlIs(route('daftar-spm-review', 2).'*') ? 'active' : '' }}" href="{{ route('daftar-spm-review',2)}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                </span>
                <span class="nav-link-title">Menunggu Berkas Asli</span>
            </a>
        </li>

        <div class="nav-section-title">Akun</div>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ubah-password') ? 'active' : '' }}" href="{{ route('ubah-password')}}" wire:navigate>
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-1.751 .154a1 1 0 0 1 -1.086 -1.086l.154 -1.751a2 2 0 0 1 .578 -1.239l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /></svg>
                </span>
                <span class="nav-link-title">Ubah Password</span>
            </a>
        </li>
    @endif
</div>