<div>
    <x-slot:title>
        Dashboard Bendahara
    </x-slot:title>

    @if (Auth()->user()->otorisasi !== 'bendahara')
        <div class="card card-md shadow-sm border-0">
            <div class="card-body text-center py-5">
                <div class="avatar avatar-xl bg-primary-subtle text-primary rounded-circle mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                </div>
                <h2 class="h2 text-dark font-weight-bold mb-1">Selamat Datang di SMART SPM</h2>
                <p class="text-secondary">Anda berada di portal otorisasi {{ strtoupper(Auth()->user()->otorisasi) }}.</p>
            </div>
        </div>
    @else
        <!-- Welcome Hero Banner -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border-radius: 16px;">
                <div class="card-body p-4 p-md-5 text-white position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-primary text-white px-3 py-1 rounded-pill" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    PORTAL BENDAHARA
                                </span>
                                <span class="text-light opacity-75 small">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                    </svg>
                                    {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                                </span>
                            </div>
                            <h1 class="h2 font-weight-bold mb-2 text-white">
                                Selamat Datang, {{ Auth()->user()->name }}! 👋
                            </h1>
                            <p class="text-light opacity-75 mb-4" style="max-width: 600px; font-size: 0.95rem; line-height: 1.6;">
                                Kelola pengajuan Surat Perintah Membayar (SPM) untuk <strong>{{ Auth()->user()->name_instansi }}</strong> dengan cepat, aman, dan terintegrasi di SMART SPM.
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('daftar-spm') }}" wire:navigate class="btn btn-primary btn-md rounded-pill px-4 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Buat SPM Baru
                                </a>
                                <a href="{{ route('status-spm') }}" wire:navigate class="btn btn-outline-light btn-md rounded-pill px-4" style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.2);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                        <path d="M11 6h9" />
                                        <path d="M11 12h9" />
                                        <path d="M11 18h9" />
                                    </svg>
                                    Daftar & Status SPM
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Stat Cards (4 Cards Modern) -->
        <div class="col-12 mb-4">
            <div class="row row-cards">
                <!-- Total SPM -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 h-100" style="transition: transform 0.2s; border-left: 4px solid #3b82f6 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-secondary font-weight-medium small">Total SPM Diajukan</span>
                                <div class="avatar avatar-sm rounded-3 bg-blue-subtle text-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                        <path d="M9 9l1 0" />
                                        <path d="M9 13l6 0" />
                                        <path d="M9 17l6 0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="h1 mb-1 font-weight-bold text-dark">{{ $totalSpm }} <span class="fs-6 font-weight-normal text-secondary">Berkas</span></div>
                            <div class="text-muted small d-flex align-items-center justify-content-between pt-2 border-top">
                                <span>Nominal Netto:</span>
                                <strong class="text-primary">Rp {{ number_format($nominalTotalSpm, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perbaikan SPM -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 h-100" style="transition: transform 0.2s; border-left: 4px solid #f59e0b !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-secondary font-weight-medium small">Perlu Perbaikan</span>
                                <div class="avatar avatar-sm rounded-3 bg-warning-subtle text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 9v4" />
                                        <path d="M12 17h.01" />
                                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                                    </svg>
                                </div>
                            </div>
                            <div class="h1 mb-1 font-weight-bold text-dark">{{ $totalPerbaikanSpm }} <span class="fs-6 font-weight-normal text-secondary">Berkas</span></div>
                            <div class="text-muted small d-flex align-items-center justify-content-between pt-2 border-top">
                                <span>Nominal Netto:</span>
                                <strong class="text-warning">Rp {{ number_format($nominalPerbaikanSpm, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SP2D Terbit -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 h-100" style="transition: transform 0.2s; border-left: 4px solid #10b981 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-secondary font-weight-medium small">SP2D Terbit</span>
                                <div class="avatar avatar-sm rounded-3 bg-success-subtle text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="h1 mb-1 font-weight-bold text-dark">{{ $totalSp2dTerbit }} <span class="fs-6 font-weight-normal text-secondary">Berkas</span></div>
                            <div class="text-muted small d-flex align-items-center justify-content-between pt-2 border-top">
                                <span>Cair Netto:</span>
                                <strong class="text-success">Rp {{ number_format($nominalSp2dTerbit, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SPM Ditolak -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 h-100" style="transition: transform 0.2s; border-left: 4px solid #ef4444 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-secondary font-weight-medium small">SPM Ditolak</span>
                                <div class="avatar avatar-sm rounded-3 bg-danger-subtle text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="h1 mb-1 font-weight-bold text-dark">{{ $totalSpmDitolak }} <span class="fs-6 font-weight-normal text-secondary">Berkas</span></div>
                            <div class="text-muted small d-flex align-items-center justify-content-between pt-2 border-top">
                                <span>Nominal Netto:</span>
                                <strong class="text-danger">Rp {{ number_format($nominalSpmDitolak, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Section: Recent Activities & Shortcuts -->
        <div class="row row-cards">
            <!-- Table Recent SPM -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-3">
                        <div>
                            <h3 class="card-title font-weight-bold m-0 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-4 text-primary me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                                Permohonan SPM Terbaru
                            </h3>
                            <div class="text-muted small">5 Berkas pengajuan SPM terkini dari {{ Auth()->user()->name_instansi }}</div>
                        </div>
                        <a href="{{ route('status-spm') }}" wire:navigate class="btn btn-sm btn-subtle-primary rounded-pill px-3">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor / Tanggal</th>
                                    <th>Jenis / Uraian</th>
                                    <th>Nominal Netto</th>
                                    <th>Status Ajukan</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSpms as $spm)
                                    <tr>
                                        <td>
                                            <div class="font-weight-medium text-dark">{{ $spm->nomor ?? 'Draft SPM' }}</div>
                                            <div class="text-muted small">
                                                {{ $spm->tanggal ? \Carbon\Carbon::parse($spm->tanggal)->format('d/m/Y') : '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary mb-1">{{ strtoupper($spm->jenis_spm ?? 'SPM') }}</span>
                                            <div class="text-secondary small text-truncate" style="max-width: 200px;" title="{{ $spm->uraian }}">
                                                {{ $spm->uraian ?? 'Tidak ada uraian' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-weight-medium text-dark">
                                                Rp {{ number_format($spm->jumlah_netto ?? 0, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $status = strtolower($spm->status_ajukan ?? '');
                                            @endphp
                                            @if($status === 'sp2d terbit')
                                                <span class="badge bg-success text-white px-2 py-1">SP2D Terbit</span>
                                            @elseif($status === 'perlu perbaikan')
                                                <span class="badge bg-warning text-dark px-2 py-1">Perlu Perbaikan</span>
                                            @elseif($status === 'spm ditolak')
                                                <span class="badge bg-danger text-white px-2 py-1">Ditolak</span>
                                            @else
                                                <span class="badge bg-info text-white px-2 py-1">{{ ucfirst($spm->status_ajukan ?? 'Diajukan') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('status-spm') }}" wire:navigate class="btn btn-sm btn-icon btn-ghost-secondary rounded-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 6l6 6l-6 6" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-folder-off opacity-50 mb-2" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 3l18 18" />
                                                <path d="M19 19h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 1.172 -1.821m3.828 -.179h3l3 3h7a2 2 0 0 1 2 2v8" />
                                            </svg>
                                            <div>Belum ada data pengajuan SPM terbaru.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Shortcuts & Quick Info -->
            <div class="col-lg-4">
                <!-- Navigation Quick Actions Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h3 class="card-title font-weight-bold m-0 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bolt text-warning me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M13 3l-2 10h7l-9 11l2 -10h-7z" />
                            </svg>
                            Akses Cepat Bendahara
                        </h3>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('daftar-spm') }}" wire:navigate class="p-3 rounded-3 text-decoration-none border d-flex align-items-center justify-content-between hover-shadow transition-all" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-md rounded-3 bg-primary text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M12 11l0 6" />
                                            <path d="M9 14l6 0" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-dark mb-0">Input SPM Baru</div>
                                        <div class="text-secondary small">Buat & usulkan draf SPM baru</div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right text-muted" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 6l6 6l-6 6" />
                                </svg>
                            </a>

                            <a href="{{ route('status-spm') }}" wire:navigate class="p-3 rounded-3 text-decoration-none border d-flex align-items-center justify-content-between hover-shadow transition-all" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-md rounded-3 bg-info text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-files" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-dark mb-0">Status & Berkas SPM</div>
                                        <div class="text-secondary small">Pantau posisi verifikasi berkas</div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right text-muted" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 6l6 6l-6 6" />
                                </svg>
                            </a>

                            <a href="{{ route('laporan-spm', 1) }}" wire:navigate class="p-3 rounded-3 text-decoration-none border d-flex align-items-center justify-content-between hover-shadow transition-all" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-md rounded-3 bg-emerald text-white" style="background-color: #10b981;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-analytics" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 17v-5" />
                                            <path d="M12 17v-1" />
                                            <path d="M15 17v-3" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-dark mb-0">Laporan Bendahara</div>
                                        <div class="text-secondary small">Cetak & ekspor rekapitulasi SPM</div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right text-muted" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 6l6 6l-6 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info Card Guidelines -->
                <div class="card border-0 shadow-sm rounded-4 bg-primary-subtle text-primary p-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="avatar avatar-sm rounded-circle bg-primary text-white flex-shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 8l.01 0" />
                                <path d="M11 12h1l0 4h1" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1 text-primary">Petunjuk Pengajuan SPM</h4>
                            <p class="small mb-0 opacity-90" style="line-height: 1.5;">
                                Pastikan berkas pendukung (Nomor SPM, Tanggal, dan Lampiran PDF) telah lengkap dan tervalidasi sebelum menekan tombol usulkan agar proses verifikasi oleh PPK & Verifikator berjalan lancar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>