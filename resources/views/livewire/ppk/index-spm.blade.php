<div x-data="{ l: $wire.entangle('isOpen')}">
    <x-slot:title>
        Daftar SPM {{ ucwords($filterStatus) }}      
        </x-slot>


        {{-- MODAL --}}
        @if ($isRead)
        <div x-show="l">
            <div class="modal modal-blur" aria-modal="true" role="dialog" style="display: block;">
                <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content border-primary">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Lihat SPM
                            </h5>
                            <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img style="width: 70px" src="{{ asset('logo.png')}}" alt="">
                                    <h3>
                                        PEMERINTAH KABUPATEN TABALONG <br>
                                        SURAT PERINTAH MEMBAYAR
                                    </h3>
                                    <h4>{{ $jenis }}</h4>
                                </div>
                            </div>
                            <div class="border p-2 mb-3">
                                <div class="row mb-3">
                                    <label class="col-6 col-form-label text-end">Tanggal SPM</label>
                                    <div class="col">
                                        <input wire:model='tanggal' type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-6 col-form-label text-end">Nomor SPM</label>
                                    <div class="col">
                                        <input wire:model='nomor' type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-6 col-form-label text-end">Nama Instansi</label>
                                    <div class="col">
                                        <input wire:model='read_instansi' type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-6 col-form-label text-end">Jumlah SPM (Bruto)</label>
                                    <div class="col">
                                        <input wire:model='jumlah' type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-6 col-form-label text-end">Untuk Keperluan</label>
                                    <div class="col">
                                        <textarea wire:model="keperluan" class="form-control" rows="3"
                                            readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-2 mb-3">
                                 <div class="row mb-3">
                                     <label class="col-6 col-form-label text-end">Nama Pihak
                                         Ketiga/Perusahaan/Penyedia</label>
                                     <div class="col">
                                         <input wire:model='penyedia' type="text" class="form-control" readonly>
                                     </div>
                                 </div>
                                 @if($selectedPenyediaObj)
                                 <div class="row mb-3">
                                     <div class="col-12">
                                         <div class="card border-info-subtle bg-blue-lt">
                                             <div class="card-header bg-white py-2">
                                                 <h4 class="card-title text-primary m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                                                     Data Penyedia & Akun Pembayaran
                                                 </h4>
                                             </div>
                                             <div class="card-body py-2">
                                                 <div class="row">
                                                     <div class="col-md-6 border-end-md">
                                                         <div class="text-muted fw-bold small">📌 DATA PENYEDIA</div>
                                                         <div class="fw-bold text-dark fs-3 mb-1">{{ $selectedPenyediaObj['nama'] ?? '-' }}</div>
                                                         <div class="small mb-1"><strong>NPWP:</strong> {{ $selectedPenyediaObj['npwp'] ?: '-' }}</div>
                                                         <div class="small text-muted"><strong>Alamat:</strong> {{ $selectedPenyediaObj['alamat'] ?: '-' }}</div>
                                                     </div>
                                                     <div class="col-md-6 ps-md-3">
                                                         <div class="text-muted fw-bold small">🏦 AKUN PEMBAYARAN</div>
                                                         <div class="small mb-1"><strong>Bank:</strong> <span class="badge bg-blue-lt text-uppercase">{{ $selectedPenyediaObj['nama_bank'] ?: '-' }}</span></div>
                                                         <div class="small mb-1"><strong>A.N. Rekening:</strong> {{ $selectedPenyediaObj['nama_rekening'] ?: '-' }}</div>
                                                         <div class="small"><strong>No. Rekening:</strong> <span class="fw-bold font-monospace text-dark">{{ $selectedPenyediaObj['nomor_rekening'] ?: '-' }}</span></div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 @endif
                                    @if($showPpn || $ppn != 'Rp. 0')
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">PPN</label>
                                        <div class="col">
                                            <input wire:model='ppn' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    @if(!empty($id_biling_ppn))
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">ID Billing PPN</label>
                                        <div class="col">
                                            <input wire:model='id_biling_ppn' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    @endif
                                    @endif

                                    @if(!empty($pajak_lain_items))
                                        @foreach($pajak_lain_items as $idx => $item)
                                        <div class="row mb-3">
                                            <label class="col-6 col-form-label text-end">Pajak Lainnya ({{ $item['jenis'] ?? '-' }})</label>
                                            <div class="col">
                                                <input type="text" class="form-control" value="Rp. {{ number_format((float) ($item['jumlah'] ?? 0), 0, ',', '.') }} (Billing: {{ $item['id_biling'] ?? '-' }})" readonly>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">Pajak Lainnya</label>
                                        <div class="col">
                                            <input wire:model='pajak_lain' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($potongan_items))
                                         @foreach($potongan_items as $pIdx => $pItem)
                                         <div class="row mb-3">
                                             <label class="col-6 col-form-label text-end">Potongan ({{ $pItem['jenis'] ?? '-' }})</label>
                                             <div class="col">
                                                 <input type="text" class="form-control" value="Rp. {{ number_format((float) ($pItem['jumlah'] ?? 0), 0, ',', '.') }}" readonly>
                                             </div>
                                         </div>
                                         @endforeach
                                     @else
                                     <div class="row mb-3">
                                         <label class="col-6 col-form-label text-end">Potongan</label>
                                         <div class="col"> 
                                             <input wire:model='potongan' type="text" class="form-control" readonly>
                                         </div>
                                     </div>
                                     @endif
                                    
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">Jumlah SPM (Netto)</label>
                                        <div class="col">
                                            <input wire:model='jumlah_netto' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-2 mb-3">
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">Status SPM</label>
                                        <div class="col">
                                            <div class="form-control-plaintext text-uppercase fw-bold">
                                                @if ($read_status_ajukan === 'perlu perbaikan')
                                                    <span class="badge bg-danger">Perlu Perbaikan</span>
                                                @elseif ($read_status_ajukan === 'spm ditolak')
                                                    <span class="badge bg-dark">SPM Ditolak</span>
                                                @elseif ($read_status_ajukan === 'sp2d terbit')
                                                    <span class="badge bg-success">SP2D Terbit</span>
                                                @elseif ($read_status_ajukan === 'diajukan')
                                                    <span class="badge bg-primary">Diusulkan</span>
                                                @elseif ($read_status_ajukan === 'verifikasi')
                                                    <span class="badge bg-info">Verifikasi</span>
                                                @elseif ($read_status_ajukan === 'menunggu berkas asli')
                                                    <span class="badge bg-warning">Menunggu Berkas Asli</span>
                                                @elseif ($read_status_ajukan === 'diproses')
                                                    <span class="badge bg-azure">Diproses</span>
                                                @elseif ($read_status_ajukan === 'draft')
                                                    <span class="badge bg-secondary">Draft</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $read_status_ajukan ?? '-' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($read_status_ajukan === 'perlu perbaikan')
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end text-danger fw-bold">Catatan {{ ucfirst($read_dari_ajukan ?? '') }}:</label>
                                        <div class="col">
                                            <div class="alert alert-danger mb-0 py-2">
                                                @if ($read_dari_ajukan === 'ppk')
                                                    {!! nl2br(e($read_catatan_ppk)) !!}
                                                @elseif ($read_dari_ajukan === 'verifikator')
                                                    {!! nl2br(e($read_catatan_verifikator)) !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @elseif ($read_status_ajukan === 'spm ditolak')
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end text-dark fw-bold">Catatan Admin:</label>
                                        <div class="col">
                                            <div class="alert alert-dark mb-0 py-2">
                                                {!! nl2br(e($read_catatan_admin)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="border p-2 mb-3">
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">Nomor SP2D</label>
                                        <div class="col">
                                            <input wire:model='nomor_sp2d' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-2 mb-3">
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">Tanggal Bayar Pajak</label>
                                        <div class="col">
                                            <input wire:model='tanggal_bayar_pajak' type="text" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">NTPN</label>
                                        <div class="col">
                                            <input wire:model='ntpn' type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-3 mb-3 rounded bg-light">
                                    <div class="row align-items-center">
                                        <label class="col-sm-4 col-form-label text-sm-end fw-bold text-dark">Lampiran Dokumen:</label>
                                        <div class="col-sm-8">
                                            @if(!empty($existingDokumen) && is_array($existingDokumen) && count($existingDokumen) > 0)
                                                <div class="d-flex flex-column gap-2">
                                                    @foreach($existingDokumen as $doc)
                                                        <div>
                                                            <a href="{{ route('preview.pdf', ['dn' => $nomor ?? 'SPM', 'file' => $doc['file']]) }}"
                                                                target="_blank" class="btn btn-sm btn-outline-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf me-1">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                                    <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                                    <path d="M17 18h2" />
                                                                    <path d="M20 15h-3v6" />
                                                                    <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                                                </svg>
                                                                {{ $doc['nama'] ?? 'Dokumen Lampiran.pdf' }}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">Tidak ada dokumen lampiran</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                {{-- End Read --}}

                        </div>



                    </div>
                </div>
            </div>

        </div>
        @endif
        {{-- END MODAL --}}


        @if ($kode == 1 || $kode == 2 && Auth()->user()->otorisasi === 'verifikator' )
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs nav-fill border-0 border-bottom-0">
                    <li class="nav-item" >
                        <a href="{{ route('daftar-spm-review',1)}}#tabs-1" wire:navigate class="nav-link  {{ ($kode == 1) ? 'active' : '' }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 9l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M9 17l6 0" />
                    </svg> Belum Verifikasi
                    </a>
                    </li>
                <li class="nav-item">
                       <a href="{{ route('daftar-spm-review',2)}}#tabs-2" wire:navigate class="nav-link {{ ($kode == 2) ? 'active' : '' }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                    <path d="M9 9l1 0" />
                    <path d="M9 13l6 0" />
                    <path d="M9 17l6 0" />
                </svg> Sudah Verifikasi
             </a>
                </li>                
                </ul>
            </div>
        </div>
        @endif

        @if ($kode == 3 || $kode == 4 && Auth()->user()->otorisasi === 'admin')
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs nav-fill border-0 border-bottom-0">
                    <li class="nav-item" >
                        <a href="{{ route('daftar-spm-review',3)}}#tabs-1" wire:navigate class="nav-link  {{ ($kode == 3) ? 'active' : '' }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 9l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M9 17l6 0" />
                    </svg> Belum Verifikasi
                    </a>
                    </li>
                <li class="nav-item">
                       <a href="{{ route('daftar-spm-review',4)}}#tabs-2" wire:navigate class="nav-link {{ ($kode == 4) ? 'active' : '' }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                    <path d="M9 9l1 0" />
                    <path d="M9 13l6 0" />
                    <path d="M9 17l6 0" />
                </svg> Sudah Verifikasi
             </a>
                </li>                
                </ul>
            </div>
        </div>
        @endif

              <div class="col-12 tab-pane active show" id="tabs-{{$kode}}">
            <div class="card shadow-sm border-0 rounded-3" style="{{ ($kode == 1 || $kode == 2 && Auth()->user()->otorisasi === 'verifikator') ||  ($kode == 3 || $kode == 4 && Auth()->user()->otorisasi === 'admin') ? 'border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;' : '' }}">
                <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <h3 class="card-title fw-bold text-dark m-0">
                            {{ $kode == 5 ? 'Daftar Dokumen SP2D Terbit' : 'Daftar SPM ' . ucwords($filterStatus) }}
                        </h3>
                        <p class="text-muted small m-0">
                            {{ $kode == 5 ? 'Kelola dan lihat data SP2D yang telah diterbitkan serta pencatatan NTPN' : 'Verifikasi dan proses pengajuan berkas SPM' }}
                        </p>
                    </div>
                </div>

                <div class="card-body border-bottom bg-light-subtle py-3">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6 col-lg-5">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <div wire:loading wire:target="query"
                                        class="spinner-border spinner-border-sm text-secondary">
                                    </div>
                                    <svg wire:loading.remove wire:target="query" xmlns="http://www.w3.org/2000/svg"
                                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg>
                                </span>
                                @if ($kode == 0 || $kode == 1 || $kode == 2 || $kode == 3 || $kode == 4)
                                <input wire:model.live="query" type="search" class="form-control bg-white shadow-none"
                                    placeholder="Cari Nomor SPM / Jenis SPM / Penyedia..." />
                                @elseif ($kode==5)
                                <input wire:model.live="query" type="search" class="form-control bg-white shadow-none"
                                    placeholder="Cari Nomor SPM / Nomor SP2D / Penyedia..." />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-hover text-nowrap datatable">
                        <thead class="bg-light">
                            <tr>
                                <th class="w-1 text-center">No.</th>
                                @if ($kode == 0 || $kode == 1 || $kode == 2 || $kode == 3 || $kode == 4)
                                    @if ($kode == 2)                                            
                                    <th>Nomor Register</th>
                                    @endif
                                    <th>Tanggal SPM</th>
                                    <th>Nomor SPM</th>
                                    <th>Jenis SPM</th>
                                    <th>Jumlah Pengajuan</th>
                                    <th>Pihak Ketiga / Penyedia</th>
                                    <th>Dokumen Pendukung</th>
                                    <th>Untuk Keperluan</th>
                                @elseif ($kode == 5)
                                    <th>Nomor SPM</th>
                                    <th>Nomor SP2D</th>
                                    <th>Jenis SPM</th>
                                    <th>Jumlah Pengajuan</th>
                                    <th>Pihak Ketiga / Penyedia</th>
                                    <th>NTPN</th>
                                @endif
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $spms as $key => $data )
                            <tr wire:key="{{ $data->id }}" class="transition-all">
                                <td class="text-center fw-medium text-muted"> {{ $spms->firstItem() + $key }} </td>
                                @if ($kode == 0 || $kode == 1 || $kode == 2 || $kode == 3 || $kode == 4)
                                    @if ($kode == 2)                                            
                                    <td class="text-wrap"> <span class="badge bg-secondary-lt font-monospace px-2 py-1">{{ $data->nomor_register }}</span> </td>
                                    @endif
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $data->tanggal->format('d M Y') }}</div>
                                    </td>
                                    <td class="text-wrap">
                                        <span class="fw-bold font-monospace text-primary">{{ $data->nomor }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <span class="badge bg-blue-lt text-uppercase font-weight-bold px-2 py-1">{{ $data->jenis }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <div class="fw-bold text-dark">Rp {{ number_format($data->jumlah, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="text-wrap">
                                        <div class="fw-semibold text-dark">{{ $data->penyedia ?: '-' }}</div>
                                    </td>
                                    <td class="text-wrap">
                                        @if(!empty($data->dokumen_list) && is_array($data->dokumen_list))
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($data->dokumen_list as $doc)
                                                    <a href="{{ route('preview.pdf', ['dn' => $data->nomor ?? 'SPM', 'file' => $doc['file']]) }}"
                                                        target="_blank" class="btn btn-sm btn-icon btn-outline-danger me-1"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $doc['nama'] ?? 'Lihat PDF' }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icon-tabler-file-type-pdf">
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
                                    <td class="text-wrap">
                                        <div class="small text-muted text-truncate" style="max-width: 200px;" title="{{ $data->keperluan }}">{{ $data->keperluan ?: '-' }}</div>
                                    </td>
                                @elseif ($kode == 5)
                                    <td class="text-wrap">
                                        <span class="fw-bold font-monospace text-primary">{{ $data->nomor }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <span class="badge bg-success-lt font-monospace fw-bold px-2 py-1">{{ $data->sp2d->nomor_sp2d ?? '-' }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <span class="badge bg-blue-lt text-uppercase font-weight-bold px-2 py-1">{{ $data->jenis }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <div class="fw-bold text-dark">Rp {{ number_format($data->jumlah, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="text-wrap">
                                        <div class="fw-semibold text-dark">{{ $data->penyedia ?: '-' }}</div>
                                    </td>
                                    <td class="text-wrap">
                                        @if($data->ntpn)
                                            <span class="badge bg-azure-lt font-monospace px-2 py-1">{{ $data->ntpn }}</span>
                                        @else
                                            <span class="badge bg-secondary-lt px-2 py-1">Belum Input</span>
                                        @endif
                                    </td>
                                @endif
                                <td class="text-end pe-4">
                                    <div class="btn-list flex-nowrap justify-content-end">
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat SPM" wire:click="readId('{{ $data->id }}')"
                                            class="btn btn-sm btn-icon btn-outline-success shadow-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </button>
                                        @if ($kode != '5' && $kode !='2' && $kode !='3' )
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Kembalikan SPM" wire:click="perbaikanId('{{ $data->id }}')"
                                            class="btn btn-sm btn-icon {{ $kode == 4 ? 'btn-outline-danger' : 'btn-outline-warning' }} shadow-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-x">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                        @endif

                                        @if ($kode != 3 && Auth()->user()->otorisasi != 'admin')
                                            @if ($kode == 5)
                                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->ntpn ? 'Ubah NTPN' : 'Input NTPN' }}" wire:click="setujiId('{{ $data->id }}')"
                                                class="btn btn-sm btn-icon {{ $data->ntpn ? 'btn-outline-info' : 'btn-primary' }} shadow-xs">
                                                @if ($data->ntpn != null)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-forms">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 3a3 3 0 0 0 -3 3v12a3 3 0 0 0 3 3" />
                                                    <path d="M6 3a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3" />
                                                    <path d="M13 7h7" />
                                                    <path d="M13 17h7" />
                                                    <path d="M13 12h7" />
                                                </svg>
                                                @endif
                                            </button>
                                            @else
                                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Setujui SPM" wire:click="setujiId('{{ $data->id }}')"
                                                class="btn btn-sm btn-icon btn-primary shadow-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </button>
                                            @endif
                                        @endif
                                        @if ($kode == 4 && Auth()->user()->otorisasi == 'admin')
                                        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Setujui SPM" wire:click="setujiId('{{ $data->id }}')"
                                            class="btn btn-sm btn-icon btn-primary shadow-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="empty">
                                        <div class="empty-icon text-muted mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
                                        </div>
                                        <p class="empty-title fw-bold text-dark mb-1">Tidak ada data ditemukan</p>
                                        <p class="empty-subtitle text-muted small mb-0">Belum ada dokumen yang tersedia pada kategori ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white d-flex align-items-center justify-content-between py-3">
                    {{ $spms->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
</div></div>

</div>