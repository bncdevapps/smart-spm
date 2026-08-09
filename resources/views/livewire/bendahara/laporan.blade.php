<div>
    <x-slot:title>
        {{ $nama }}
    </x-slot>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h3 class="card-title fw-bold text-dark m-0">{{ $nama }}</h3>
                <p class="text-muted small m-0">
                    {{ $kode == 1 ? 'Filter dan cetak register rekapitulasi Surat Perintah Membayar (SPM)' : 'Filter dan cetak register rekapitulasi Surat Perintah Pencairan Dana (SP2D)' }}
                </p>
            </div>
        </div>

        <form wire:submit.prevent>
            <div class="card-body bg-light-subtle py-4">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold text-dark">Periode Tanggal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted small border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                            </span>
                            <input wire:model="dari_tanggal" type="date"
                                class="form-control bg-white shadow-none @error('dari_tanggal') is-invalid @enderror">

                            <span class="input-group-text bg-light text-muted fw-bold small px-3">
                                s/d
                            </span>
                            <input wire:model="sampai_tanggal" type="date"
                                class="form-control bg-white shadow-none @error('sampai_tanggal') is-invalid @enderror">
                        </div>
                        <x-input-error2 for="dari_tanggal" />
                        <x-input-error2 for="sampai_tanggal" />
                    </div>

                    @if (Auth()->user()->otorisasi === 'admin')
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold text-dark">Instansi</label>
                        <select wire:model="instansi"
                            class="form-select bg-white shadow-none @error('instansi') is-invalid @enderror">
                            <option value="semua">Semua Instansi</option>
                            @foreach ($instansis as $data )
                            <option value="{{$data->nama}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                        <x-input-error2 for="instansi" />
                    </div>
                    @endif

                    @if ($kode == 1)
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold text-dark">Status SPM</label>
                        <select wire:model="status" class="form-select bg-white shadow-none @error('status') is-invalid @enderror">
                            <option value="semua">Semua Status SPM</option>
                            <option value="diajukan">Diusulkan</option>
                            <option value="verifikasi">Verifikasi</option>
                            <option value="perlu perbaikan">Perlu Perbaikan</option>
                            <option value="menunggu berkas asli">Menunggu Berkas Asli</option>
                            <option value="diproses">Diproses</option>
                            <option value="spm ditolak">SPM Ditolak</option>
                        </select>
                        <x-input-error2 for="status" />
                    </div>
                    @endif

                    <div class="col-lg-6">
                        <div x-data="{ open: false, search: '' }">
                            <label class="form-label fw-semibold text-dark">
                                Penyedia / Rekanan <span class="form-label-description text-muted">(Opsional)</span>
                            </label>
                            <div class="position-relative">
                                <div @click="open = !open"
                                     class="form-select text-start cursor-pointer bg-white shadow-none d-flex justify-content-between align-items-center @error('filter_penyedia') is-invalid @enderror">
                                    <span class="text-truncate">
                                        {{ $filter_penyedia && $filter_penyedia !== 'semua' ? $filter_penyedia : 'Semua Penyedia / Rekanan' }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down ms-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                                </div>

                                <div x-show="open" @click.outside="open = false" x-transition class="dropdown-menu show w-100 p-2 shadow-lg" style="max-height: 300px; overflow-y: auto; z-index: 1055;">
                                    <div class="mb-2 position-sticky top-0 bg-white pt-1 pb-1 border-bottom">
                                        <input type="text" x-model="search" @click.stop class="form-control form-control-sm" placeholder="Cari Penyedia..." autofocus>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <button type="button"
                                            wire:click="$set('filter_penyedia', 'semua')"
                                            @click="open = false; search = ''"
                                            class="list-group-item list-group-item-action py-2 text-start border-bottom @if($filter_penyedia === 'semua') active @endif">
                                            <div class="fw-bold">Semua Penyedia / Rekanan</div>
                                        </button>
                                        @forelse ($penyedias as $pData)
                                            <button type="button"
                                                x-show="!search || '{{ strtolower($pData->nama . ' ' . $pData->npwp . ' ' . $pData->nama_bank) }}'.includes(search.toLowerCase())"
                                                wire:click="$set('filter_penyedia', '{{ $pData->nama }}')"
                                                @click="open = false; search = ''"
                                                class="list-group-item list-group-item-action py-2 text-start border-bottom @if($filter_penyedia === $pData->nama) active @endif">
                                                <div class="fw-bold text-dark">{{ $pData->nama }}</div>
                                                <div class="small text-muted d-flex justify-content-between flex-wrap">
                                                    <span>NPWP: {{ $pData->npwp ?: '-' }}</span>
                                                    @if($pData->nama_bank || $pData->nomor_rekening)
                                                        <span>{{ $pData->nama_bank }} - {{ $pData->nomor_rekening }}</span>
                                                    @endif
                                                </div>
                                            </button>
                                        @empty
                                            <div class="text-muted small text-center py-2">Belum ada data Penyedia/Rekanan tersimpan.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <x-input-error2 for="filter_penyedia" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <button type="button" wire:loading.attr="disabled"
                        wire:click='viewPreview' class="btn btn-secondary shadow-sm rounded-pill px-4 me-1">
                        <div wire:loading wire:target='viewPreview' class="spinner-border spinner-border-sm me-2"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icon-tabler-eye me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                        Preview Laporan
                    </button>
                    <button type="button" wire:loading.attr="disabled" wire:click='exportExcel'
                        class="btn btn-success shadow-sm rounded-pill px-4 me-1">
                        <div wire:loading wire:target='exportExcel' class="spinner-border spinner-border-sm me-2"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-spreadsheet me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <path d="M8 11h8v7h-8z" />
                            <path d="M8 15h8" />
                            <path d="M11 11v7" />
                        </svg>
                        Export Excel
                    </button>
                    <button type="button" wire:loading.attr="disabled" wire:click='exportPdf'
                        class="btn btn-outline-danger shadow-sm rounded-pill px-4">
                        <div wire:loading wire:target='exportPdf' class="spinner-border spinner-border-sm me-2"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-type-pdf me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                        </svg>
                        Export PDF
                    </button>
                </div>
            </div>

            @if ($preview)
            <div class="card-body border-top p-0">
                <div class="p-3 bg-light d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold text-dark m-0">Hasil Preview Laporan</h4>
                    <span class="badge bg-primary-lt">Total: {{ count($spms) }} Data</span>
                </div>
                
                @if ($kode == 1)
                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-hover text-nowrap datatable">
                        <thead class="bg-light">
                            <tr>
                                <th class="w-1 text-center">No.</th>
                                <th>Tanggal SPM</th>
                                <th>Nomor SPM</th>
                                <th>Jenis SPM</th>
                                <th>Jumlah Pengajuan</th>
                                <th>Pihak Ketiga / Penyedia</th>
                                <th class="text-center">Status SPM</th>
                                <th>Dokumen Pendukung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $spms as $key => $data )
                            <tr class="transition-all">
                                <td class="text-center fw-medium text-muted"> {{ $key + 1 }} </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ date('d M Y', strtotime($data['tanggal'])) }}</div>
                                </td>
                                <td class="text-wrap">
                                    <span class="fw-bold font-monospace text-primary">{{ $data['nomor'] }}</span>
                                </td>
                                <td class="text-wrap">
                                    <span class="badge bg-blue-lt text-uppercase font-weight-bold px-2 py-1">{{ $data['jenis'] }}</span>
                                </td>
                                <td class="text-wrap">
                                    <div class="fw-bold text-dark">Rp {{ number_format($data['jumlah'], 0, ',', '.') }}</div>
                                </td>
                                <td class="text-wrap">
                                    <div class="fw-semibold text-dark">{{ $data['penyedia'] ?: '-' }}</div>
                                </td>
                                <td class="text-center text-wrap">
                                    <span class="badge bg-info-lt text-uppercase fw-bold px-2 py-1">
                                        {{ $data['status_ajukan'] === 'diajukan' ? 'DIUSULKAN' : strtoupper($data['status_ajukan']) }}
                                    </span>
                                </td>
                                <td class="text-wrap">
                                    @if(!empty($data['dokumen_list']) && is_array($data['dokumen_list']))
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($data['dokumen_list'] as $doc)
                                                <a href="{{ route('preview.pdf', ['dn' => $data['nomor'] ?? 'SPM', 'file' => $doc['file']]) }}"
                                                    target="_blank" class="btn btn-sm btn-icon btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $doc['nama'] ?? 'Lihat PDF' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-type-pdf">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                        <path d="M17 18h2" />
                                                        <path d="M20 15h-3v6" />
                                                    </svg>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty">
                                        <div class="empty-icon text-muted mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
                                        </div>
                                        <p class="empty-title fw-bold text-dark mb-1">Tidak ada data ditemukan</p>
                                        <p class="empty-subtitle text-muted small mb-0">Tidak ada data SPM yang sesuai dengan kriteria periode tanggal & filter yang dipilih.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @elseif ($kode == 2)
                <div class="p-3 border-bottom bg-white text-center">
                    <h4 class="fw-bold text-dark m-0">PEMERINTAH KABUPATEN TABALONG</h4>
                    <div class="text-muted small">{{ Auth()->user()->name_instansi }}</div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-bordered table-hover datatable">
                        <thead class="text-center align-middle bg-light">
                            <tr>
                                <th rowspan="2" class="w-1">No.</th>
                                <th rowspan="2">INSTANSI</th>
                                <th colspan="2">SP2D</th>
                                <th colspan="4">POTONGAN PAJAK & DEDUCTION</th>
                                <th rowspan="2">NPWP BENDAHARA/REKANAN</th>
                                <th rowspan="2">NAMA BENDAHARA/REKANAN</th>
                                <th rowspan="2">NTPN</th>
                                <th rowspan="2">TANGGAL BAYAR</th>
                            </tr>
                            <tr>
                                <th>NOMOR</th>
                                <th>NILAI BELANJA (BRUTO)</th>
                                <th>PPN</th>
                                <th>PAJAK LAINNYA</th>
                                <th>POTONGAN</th>
                                <th>NILAI NETTO</th>
                            </tr>
                            <tr class="text-muted small bg-light-subtle">
                                <th>(1)</th>
                                <th>(2)</th>
                                <th>(3)</th>
                                <th>(4)</th>
                                <th>(5)</th>
                                <th>(6)</th>
                                <th>(7)</th>
                                <th>(8)</th>
                                <th>(9)</th>
                                <th>(10)</th>
                                <th>(11)</th>
                                <th>(12)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($spms as $index => $spm)
                            <tr>
                                <td class="text-center fw-medium text-muted">{{ $index + 1 }}</td>
                                <td>{{ $spm['instansi'] ?? '-' }}</td>
                                <td><span class="badge bg-success-lt font-monospace px-2 py-1">{{ $spm['nomor_sp2d'] ?? '-' }}</span></td>
                                <td class="text-end fw-bold text-dark">Rp {{ number_format((float)($spm['jumlah'] ?? 0), 0, ',', '.') }}</td>
                                <td>
                                    Rp {{ number_format((float)($spm['ppn'] ?? 0), 0, ',', '.') }}
                                    @if(!empty($spm['id_biling_ppn']))
                                        <br><small class="text-muted font-monospace">Billing: {{ $spm['id_biling_ppn'] }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($spm['pajak_lain_items']) && is_array($spm['pajak_lain_items']))
                                        @foreach($spm['pajak_lain_items'] as $pItem)
                                            <div class="small">
                                                <span class="fw-bold">{{ $pItem['jenis'] ?? '-' }}:</span> 
                                                Rp {{ number_format((float)($pItem['jumlah'] ?? 0), 0, ',', '.') }}
                                                @if(!empty($pItem['id_biling']))
                                                    <br><small class="text-muted font-monospace">Billing: {{ $pItem['id_biling'] }}</small>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        {{ $spm['pajak_lain'] ?? '-' }} (Rp {{ number_format((float)($spm['jumlah_pajak_lain'] ?? 0), 0, ',', '.') }})
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($spm['potongan_items']) && is_array($spm['potongan_items']))
                                        @foreach($spm['potongan_items'] as $pot)
                                            <div class="small">
                                                <span class="fw-bold">{{ $pot['jenis'] ?? '-' }}:</span> 
                                                Rp {{ number_format((float)($pot['jumlah'] ?? 0), 0, ',', '.') }}
                                            </div>
                                        @endforeach
                                    @else
                                        {{ $spm['potongan'] ?? '-' }} (Rp {{ number_format((float)($potongan['jumlah_potongan'] ?? 0), 0, ',', '.') }})
                                    @endif
                                </td>
                                <td class="text-end fw-bold text-success">
                                    Rp {{ number_format((float)($spm['jumlah_netto'] ?? 0), 0, ',', '.') }}
                                </td>
                                <td class="font-monospace small">{{ $spm['npwp_bendahara'] ?? '-' }}</td>
                                <td class="fw-semibold text-dark">{{ $spm['penyedia'] ?? '-' }}</td>
                                <td>
                                    @if(!empty($spm['ntpn']))
                                        <span class="badge bg-azure-lt font-monospace px-2 py-1">{{ $spm['ntpn'] }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    {{ !empty($spm['tanggal_bayar_pajak']) ? date('d M Y', strtotime($spm['tanggal_bayar_pajak'])) : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center py-5">
                                    <div class="empty">
                                        <div class="empty-icon text-muted mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
                                        </div>
                                        <p class="empty-title fw-bold text-dark mb-1">Tidak ada data ditemukan</p>
                                        <p class="empty-subtitle text-muted small mb-0">Tidak ada data SP2D yang sesuai dengan kriteria periode tanggal & filter yang dipilih.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @endif
        </form>
    </div>
</div>