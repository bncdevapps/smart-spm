<div x-data="{ l: $wire.entangle('isOpen')}">
    <x-slot:title>
        Status SPM
        </x-slot>


        {{-- MODAL --}}
        <div x-show="l">
            <div class="modal modal-blur" aria-modal="true" role="dialog" style="display: block;">
                <div class="modal-dialog modal-lg modal-dialog-centered " role="document"
                    {{-- x-on:click.outside="l = false" --}}>
                    <div class="modal-content border-primary">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ $isRead ? 'Lihat SPM' : 'Perbaikan SPM' }}
                            </h5>
                            {{-- <button x-on:click="l = false" type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button> --}}
                            <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit="{{ $isRead ?'': 'UpdatePerbaikan' }}">
                            <div class="modal-body">

                                @if ($isRead)

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
                                    @if(!empty($id_biling_pajak))
                                    <div class="row mb-3">
                                        <label class="col-6 col-form-label text-end">ID Billing Pajak</label>
                                        <div class="col">
                                            <input wire:model='id_biling_pajak' type="text" class="form-control"
                                                readonly>
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
                                                 <input type="text" class="form-control" value="Rp. {{ number_format((float) ($pItem['jumlah'] ?? 0), 0, ',', '.') }}{{ !empty($pItem['id_biling']) ? ' (Billing: '.$pItem['id_biling'].')' : '' }}" readonly>
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
                                            <input wire:model='tanggal_bayar_pajak' type="text" class="form-control" readonly>
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
                                @else



                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal SPM</label>
                                            <input wire:model="tanggal" type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror">
                                            <x-input-error2 for="tanggal" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor SPM</label>
                                            <input wire:model="nomor" type="text"
                                                class="form-control @error('nomor') is-invalid @enderror">
                                            <x-input-error2 for="nomor" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis SPM</label>
                                            <select wire:model.live="jenis"
                                                class="form-select @error('jenis') is-invalid @enderror">
                                                <option selected="">Cari...</option>
                                                <hr>
                                                @foreach ($jenisspms as $data )
                                                <option value="{{$data->nama}}">{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error2 for="jenis" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah SPM (Bruto)</label>
                                            <div class="input-group input-group-flat ">
                                                <span class="input-group-text pe-1 ">
                                                    Rp.
                                                </span>
                                                <input wire:model.live="jumlah" x-data
                                                    x-mask:dynamic="$money($input, ',')" type="text"
                                                    class="form-control ps-0 @error('jumlah') is-invalid @enderror">
                                                <x-input-error2 for="jumlah" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Untuk Keperluan</label>
                                            <textarea wire:model="keperluan"
                                                class="form-control @error('keperluan') is-invalid @enderror"
                                                rows="3"></textarea>
                                            <x-input-error2 for="keperluan" />
                                        </div>
                                    </div>

                                    <div class="mb-3" x-data="{ open: false, search: '' }">
                                        <label class="form-label required">Nama Pihak Ketiga/Perusahaan/Penyedia</label>
                                        <div class="position-relative">
                                            <div @click="open = !open"
                                                 class="form-select text-start cursor-pointer d-flex justify-content-between align-items-center @error('penyedia') is-invalid @enderror"
                                                 style="cursor: pointer; background-color: #fff;">
                                                <span class="text-truncate" wire:loading.remove wire:target="selectPenyedia">
                                                    {{ $penyedia ?: '-- Cari Penyedia --' }}
                                                </span>
                                                <span wire:loading wire:target="selectPenyedia" class="spinner-border spinner-border-sm text-primary"></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down ms-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                                            </div>

                                            <div x-show="open" @click.outside="open = false" x-transition class="dropdown-menu show w-100 p-2 shadow-lg" style="max-height: 300px; overflow-y: auto; z-index: 1055;">
                                                <div class="mb-2 position-sticky top-0 bg-white pt-1 pb-1 border-bottom">
                                                    <input type="text" x-model="search" @click.stop class="form-control form-control-sm" placeholder="Cari Penyedia..." autofocus>
                                                </div>
                                                <div class="list-group list-group-flush">
                                                    @forelse ($penyedias as $pData)
                                                        <button type="button"
                                                            x-show="!search || '{{ strtolower($pData->nama . ' ' . $pData->npwp . ' ' . $pData->nama_bank) }}'.includes(search.toLowerCase())"
                                                            wire:click="selectPenyedia({{ $pData->id }})"
                                                            @click="open = false; search = ''"
                                                            class="list-group-item list-group-item-action py-2 text-start border-bottom">
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
                                        <x-input-error2 for="penyedia" />
                                    </div>
                                    @if($selectedPenyediaObj)
                                     <div class="mb-3">
                                         <div class="card border-info-subtle bg-blue-lt">
                                             <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                                                 <h4 class="card-title text-primary m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                                                     Data Penyedia & Akun Pembayaran
                                                 </h4>
                                                 <span class="badge bg-success-lt">Terdaftar</span>
                                             </div>
                                             <div class="card-body py-2">
                                                 <div class="row">
                                                     <div class="col-md-6 border-end-md mb-2 mb-md-0">
                                                         <div class="text-muted fw-bold small">📌 DATA PENYEDIA</div>
                                                         <div class="fw-bold text-dark fs-3 mb-1">{{ $selectedPenyediaObj['nama'] ?? '-' }}</div>
                                                         <div class="small mb-1"><strong>NPWP:</strong> {{ $selectedPenyediaObj['npwp'] ?: '-' }}</div>
                                                         <div class="small text-muted"><strong>Alamat:</strong> {{ $selectedPenyediaObj['alamat'] ?: '-' }}</div>
                                                     </div>
                                                     <div class="col-md-6 ps-md-3">
                                                         <div class="text-muted fw-bold small">🏦 AKUN PEMBAYARAN</div>
                                                         <div class="small mb-1"><strong>Nama Bank:</strong> <span class="badge bg-blue-lt text-uppercase">{{ $selectedPenyediaObj['nama_bank'] ?: '-' }}</span></div>
                                                         <div class="small mb-1"><strong>A.N. Rekening:</strong> {{ $selectedPenyediaObj['nama_rekening'] ?: '-' }}</div>
                                                         <div class="small"><strong>No. Rekening:</strong> <span class="fw-bold font-monospace text-dark">{{ $selectedPenyediaObj['nomor_rekening'] ?: '-' }}</span></div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     @endif
                                </div>


                                <div class="row">
                                <div class="card mb-3 border-secondary">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light py-2">
                                        <h4 class="card-title m-0">Pajak</h4>
                                        <div>
                                            @if(!$showPpn)
                                                <button type="button" wire:click="togglePpn" class="btn btn-sm btn-outline-success me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                    Tambah PPN
                                                </button>
                                            @endif
                                            <button type="button" wire:click="addPajakLainItem" class="btn btn-sm btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Tambah Pajak Lainnya
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        {{-- PPN Card --}}
                                        @if($showPpn)
                                            <div class="border rounded p-3 mb-3 bg-light-subtle">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <strong class="text-success">📌 PPN</strong>
                                                    <button type="button" wire:click="togglePpn" class="btn btn-sm btn-outline-danger" title="Hapus PPN">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> Hapus PPN
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label">Nominal PPN</label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text pe-1">Rp.</span>
                                                            <input wire:model.live="ppn" x-data x-mask:dynamic="$money($input, ',')" type="text" class="form-control ps-0 @error('ppn') is-invalid @enderror">
                                                        </div>
                                                        <x-input-error2 for="ppn" />
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label">ID Billing PPN</label>
                                                        <input wire:model="id_biling_ppn" type="text" class="form-control @error('id_biling_ppn') is-invalid @enderror" placeholder="Masukkan ID Billing PPN">
                                                        <x-input-error2 for="id_biling_ppn" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Pajak Lainnya Cards --}}
                                        @foreach($pajak_lain_items as $index => $item)
                                            <div class="border rounded p-3 mb-3 bg-light-subtle" wire:key="pajak-lain-{{ $index }}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <strong class="text-primary">📌 Pajak Lainnya #{{ $index + 1 }}</strong>
                                                    <button type="button" wire:click="removePajakLainItem({{ $index }})" class="btn btn-sm btn-outline-danger" title="Hapus Pajak ini">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> Hapus
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">Jenis Pajak</label>
                                                        <select wire:model="pajak_lain_items.{{ $index }}.jenis" class="form-select @error('pajak_lain_items.'.$index.'.jenis') is-invalid @enderror">
                                                            <option value="">-- Pilih Jenis Pajak --</option>
                                                            @foreach ($pajaks as $data)
                                                                <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error2 for="pajak_lain_items.{{ $index }}.jenis" />
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">Nominal Pajak</label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text pe-1">Rp.</span>
                                                            <input wire:model.live="pajak_lain_items.{{ $index }}.jumlah" x-data x-mask:dynamic="$money($input, ',')" type="text" class="form-control ps-0 @error('pajak_lain_items.'.$index.'.jumlah') is-invalid @enderror">
                                                        </div>
                                                        <x-input-error2 for="pajak_lain_items.'.$index.'.jumlah" />
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">ID Billing Pajak</label>
                                                        <input wire:model="pajak_lain_items.{{ $index }}.id_biling" type="text" class="form-control @error('pajak_lain_items.'.$index.'.id_biling') is-invalid @enderror" placeholder="ID Billing">
                                                        <x-input-error2 for="pajak_lain_items.'.$index.'.id_biling" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(!$showPpn && empty($pajak_lain_items))
                                            <div class="text-muted small text-center py-2 fst-italic">Belum ada pajak yang ditambahkan.</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="card mb-3 border-secondary">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light py-2">
                                        <h4 class="card-title m-0">Potongan</h4>
                                        <button type="button" wire:click="addPotonganItem" class="btn btn-sm btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                            Tambah Potongan
                                        </button>
                                    </div>
                                    <div class="card-body p-3">
                                        @foreach($potongan_items as $pIndex => $pItem)
                                            <div class="border rounded p-3 mb-3 bg-light-subtle" wire:key="potongan-{{ $pIndex }}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <strong class="text-primary">📌 Potongan #{{ $pIndex + 1 }}</strong>
                                                    <button type="button" wire:click="removePotonganItem({{ $pIndex }})" class="btn btn-sm btn-outline-danger" title="Hapus Potongan ini">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M15 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> Hapus
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">Jenis Potongan</label>
                                                        <select wire:model="potongan_items.{{ $pIndex }}.jenis" class="form-select @error('potongan_items.'.$pIndex.'.jenis') is-invalid @enderror">
                                                            <option value="">-- Pilih Jenis Potongan --</option>
                                                            @foreach ($potongans as $data)
                                                                <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error2 for="potongan_items.{{ $pIndex }}.jenis" />
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">Nominal Potongan</label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text pe-1">Rp.</span>
                                                            <input wire:model.live="potongan_items.{{ $pIndex }}.jumlah" x-data x-mask:dynamic="$money($input, ',')" type="text" class="form-control ps-0 @error('potongan_items.'.$pIndex.'.jumlah') is-invalid @enderror">
                                                        </div>
                                                        <x-input-error2 for="potongan_items.{{ $pIndex }}.jumlah" />
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label class="form-label">ID Billing Potongan</label>
                                                        <input wire:model="potongan_items.{{ $pIndex }}.id_biling" type="text" class="form-control @error('potongan_items.'.$pIndex.'.id_biling') is-invalid @enderror" placeholder="Masukkan ID Billing">
                                                        <x-input-error2 for="potongan_items.'.$pIndex.'.id_biling" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(empty($potongan_items))
                                            <div class="text-muted small text-center py-2 fst-italic">Belum ada potongan yang ditambahkan.</div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah SPM (Netto)</label>
                                            <div class="input-group input-group-flat">
                                                <span class="input-group-text pe-1">Rp.</span>
                                                <input wire:model="jumlah_netto" x-data x-mask:dynamic="$money($input, ',')" type="text" readonly class="form-control ps-0 @error('jumlah_netto') is-invalid @enderror">
                                            </div>
                                            <x-input-error2 for="jumlah_netto" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan Lampiran Dokumen Yang Harus Diupload <span class="form-label-description text-muted">(Opsional)</span></label>
                                            <textarea wire:model="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                rows="3" placeholder="Opsional / boleh dikosongkan"></textarea>
                                            <x-input-error2 for="keterangan" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Upload Dokumen Lampiran (PDF)</label>
                                            
                                            @if ($notifKeterangan != '')
                                            <div class="alert alert-warning mb-2" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon alert-icon">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 9v4"></path>
                                                            <path
                                                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                                            </path>
                                                            <path d="M12 16h.01"></path>
                                                        </svg>
                                                    </div>
                                                    <div wire:loading wire:target="jenis"
                                                        class="spinner-border spinner-border-sm m-2"></div>
                                                    <div wire:loading.remove wire:target='jenis'>
                                                        <h4 class="alert-title mb-1">Ketentuan Dokumen:</h4>
                                                        <div class="text-secondary small">
                                                            {!! nl2br($notifKeterangan) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            {{-- Daftar Berkas yang Tersimpan di Server (Mode Edit / Perbaiki) --}}
                                            @if (!empty($existingDokumen) && is_array($existingDokumen) && count($existingDokumen) > 0)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="form-label fw-bold text-dark m-0">
                                                        📑 Berkas Lampiran Tersimpan ({{ count($existingDokumen) }})
                                                    </label>
                                                    <span class="badge bg-success-lt">Tersimpan di Server</span>
                                                </div>
                                                <div class="list-group list-group-flush border rounded bg-white shadow-sm">
                                                    @foreach($existingDokumen as $idx => $doc)
                                                        <div class="list-group-item d-flex align-items-center justify-content-between p-2" wire:key="exist-doc-{{ $idx }}">
                                                            <div class="d-flex align-items-center me-2 text-truncate">
                                                                <div class="avatar bg-red-lt text-red me-2 flex-shrink-0">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                                        <path d="M17 18h2" />
                                                                        <path d="M20 15h-3v6" />
                                                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                                                    </svg>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <div class="fw-bold text-dark text-truncate small" title="{{ $doc['nama'] ?? 'Dokumen SPM.pdf' }}">
                                                                        {{ $doc['nama'] ?? 'Dokumen SPM.pdf' }}
                                                                    </div>
                                                                    <div class="text-muted" style="font-size: 11px;">
                                                                        @if(!empty($doc['size']))
                                                                            {{ number_format($doc['size'] / 1024, 1) }} KB &bull;
                                                                        @endif
                                                                        <span class="text-success fw-bold">Tersimpan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                                <a href="{{ route('preview.pdf', ['dn' => $nomor ?? 'SPM', 'file' => $doc['file']]) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a>
                                                                <button type="button" wire:click="removeExistingDokumen({{ $idx }})" class="btn btn-sm btn-outline-danger" title="Hapus dokumen ini">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif

                                            {{-- Daftar Berkas Baru yang Dipilih --}}
                                            @if (!empty($dokumen) && is_array($dokumen) && count($dokumen) > 0)
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <label class="form-label fw-bold text-primary m-0">
                                                        📤 Berkas Baru yang Dipilih ({{ count($dokumen) }})
                                                    </label>
                                                    <button type="button" wire:click="removeUploadDokumen" class="btn btn-sm btn-link text-danger p-0" style="text-decoration: none; font-size: 12px;">
                                                        Batalkan Semua
                                                    </button>
                                                </div>
                                                <div class="list-group list-group-flush border border-primary-subtle rounded bg-primary-lt shadow-sm">
                                                    @foreach($dokumen as $idx => $fileItem)
                                                        <div class="list-group-item d-flex align-items-center justify-content-between p-2 bg-transparent" wire:key="new-doc-{{ $idx }}">
                                                            <div class="d-flex align-items-center me-2 text-truncate">
                                                                <div class="avatar bg-primary text-white me-2 flex-shrink-0">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                                        <path d="M17 18h2" />
                                                                        <path d="M20 15h-3v6" />
                                                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                                                    </svg>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <div class="fw-bold text-dark text-truncate small" title="{{ method_exists($fileItem, 'getClientOriginalName') ? $fileItem->getClientOriginalName() : 'Berkas.pdf' }}">
                                                                        {{ method_exists($fileItem, 'getClientOriginalName') ? $fileItem->getClientOriginalName() : 'Berkas.pdf' }}
                                                                    </div>
                                                                    <div class="text-muted" style="font-size: 11px;">
                                                                        @if(method_exists($fileItem, 'getSize'))
                                                                            {{ number_format($fileItem->getSize() / 1024, 1) }} KB &bull;
                                                                        @endif
                                                                        <span class="badge bg-primary text-white">Siap Diunggah</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                                @if(method_exists($fileItem, 'temporaryUrl'))
                                                                    <a href="{{ $fileItem->temporaryUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Pratinjau Berkas">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                        </svg>
                                                                    </a>
                                                                @endif
                                                                <button type="button" wire:click="removeNewDokumen({{ $idx }})" class="btn btn-sm btn-outline-danger" title="Batalkan berkas ini">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M18 6l-12 12" />
                                                                        <path d="M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif

                                            {{-- Dropzone Input File --}}
                                            <div class="modern-dropzone @if(!empty($dokumen) || !empty($existingDokumen)) modern-dropzone-compact @endif @error('dokumen') border-danger bg-danger-lt @enderror @error('dokumen.*') border-danger bg-danger-lt @enderror @error('newDokumenUpload') border-danger bg-danger-lt @enderror @error('newDokumenUpload.*') border-danger bg-danger-lt @enderror">
                                                <input wire:model="newDokumenUpload" type="file" multiple accept=".pdf,application/pdf">
                                                <div class="dropzone-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                                        <path d="M9 15l3 -3l3 3" />
                                                        <path d="M12 12l0 9" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark small">
                                                        @if(!empty($existingDokumen) || !empty($dokumen))
                                                            + Tambah / Pilih berkas dokumen PDF lainnya
                                                        @else
                                                            Klik untuk memilih dokumen <span class="text-muted fw-normal">atau seret berkas PDF ke sini</span>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted" style="font-size: 12px;">
                                                        Bisa pilih lebih dari 1 file &bull; Format <span class="badge bg-red-lt font-weight-bold">PDF</span> (Maksimal 10 MB per file)
                                                    </div>
                                                </div>
                                            </div>

                                            <x-input-error2 for="dokumen" />
                                            <x-input-error2 for="dokumen.*" />
                                            <x-input-error2 for="newDokumenUpload" />
                                            <x-input-error2 for="newDokumenUpload.*" />
                                            
                                            <div wire:loading wire:target="newDokumenUpload">
                                                <div class="d-flex align-items-center text-primary mt-2">
                                                    <div class="spinner-border spinner-border-sm me-2"></div>
                                                    <span class="small font-weight-bold">Sedang memproses dan mengunggah berkas PDF...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if (!$isRead)
                            <div class="modal-footer">
                                <div class="d-flex">
                                    <div wire:loading wire:target='UpdatePerbaikan' class="spinner-border  me-2 mt-2">
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                        Perbaikan Selesai
                                    </button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>
        {{-- END MODAL --}}

        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                {{-- CARD HEADER & TITLE --}}
                <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <h3 class="card-title fw-bold text-dark m-0">Status & Riwayat Otorisasi SPM</h3>
                        <p class="text-muted small m-0">Pantau proses verifikasi dan alur pengajuan Surat Perintah Membayar</p>
                    </div>
                </div>

                <div class="card-body border-bottom bg-light-subtle py-3">
                    <div class="row g-2 align-items-center">
                        {{-- Input Pencarian --}}
                        <div class="col-12 col-md-5">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg>
                                </span>
                                <input wire:model.live.debounce.300ms="query" type="search" class="form-control bg-white shadow-none"
                                    placeholder="Cari Nomor / Jenis / Status / Penyedia..." />
                            </div>
                        </div>

                        {{-- Filter Status SPM --}}
                        <div class="col-6 col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted small border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.828 4.828a2 2 0 0 0 -.586 1.414v3.172l-4 4v-7.172a2 2 0 0 0 -.586 -1.414l-4.828 -4.828a2 2 0 0 1 -.586 -1.414v-2.172z" />
                                    </svg>
                                    Status:
                                </span>
                                <select class="form-select bg-white border-start-0 ps-0 shadow-none" wire:model.live="filter_status_spm">
                                    <option value="semua">Semua Status</option>
                                    <option value="diajukan">Diusulkan</option>
                                    <option value="verifikasi">Verifikasi</option>
                                    <option value="menunggu berkas asli">Menunggu Berkas Asli</option>
                                    <option value="perlu perbaikan">Perlu Perbaikan</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="sp2d terbit">SP2D Terbit</option>
                                    <option value="spm ditolak">SPM Ditolak</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        {{-- Filter Jenis SPM --}}
                        <div class="col-6 col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted small border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    </svg>
                                    Jenis:
                                </span>
                                <select class="form-select bg-white border-start-0 ps-0 shadow-none" wire:model.live="filter_jenis">
                                    <option value="semua">Semua Jenis</option>
                                    @foreach($jenisspms as $jspm)
                                        <option value="{{ $jspm->nama }}">{{ $jspm->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Reset Filter Button --}}
                        <div class="col-12 col-md-1 text-md-end">
                            @if($filter_status_spm !== 'semua' || $filter_jenis !== 'semua' || !empty($query))
                                <button type="button" wire:click="resetFilter" class="btn btn-outline-secondary w-100 px-2 shadow-none" title="Reset Filter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                    <span class="d-md-none ms-1">Reset</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Loading indicator --}}
                    <div wire:loading wire:target="filter_status_spm, filter_jenis, query, resetFilter" style="display: none;">
                        <div class="d-flex align-items-center text-primary small mt-2">
                            <div class="spinner-border spinner-border-sm me-2"></div>
                            <span>Memfilter data status SPM...</span>
                        </div>
                    </div>
                </div>

                {{-- TABEL --}}
                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-hover text-nowrap datatable">
                        <thead class="bg-light">
                            <tr>
                                <th class="w-1 text-center">No.</th>
                                <th>Tanggal SPM</th>
                                <th>Nomor SPM</th>
                                <th>Jenis SPM</th>
                                <th>Jumlah Pengajuan</th>
                                <th class="text-center">Status SPM</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $spms as $key => $data )
                            <tr wire:key="{{ $data->id }}" class="transition-all">
                                <td class="text-center fw-medium text-muted"> {{ $spms->firstItem() + $key }} </td>
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
                                <td class="text-center text-wrap" style="min-width: 180px;">
                                    @if ($data->status_ajukan === 'perlu perbaikan')
                                        <div class="mb-1">
                                            <span class="badge bg-danger-lt text-danger fw-bold border border-danger-subtle px-2 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle me-1" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                                                PERLU PERBAIKAN
                                            </span>
                                        </div>

                                        <div x-data="{ 
                                                showFullText: false, 
                                                text: `
                                                    @if ($data->dari_ajukan === 'ppk')
                                                        {!! nl2br(e($data->catatan_ppk)) !!}
                                                    @elseif ($data->dari_ajukan === 'verifikator')
                                                        {!! nl2br(e($data->catatan_verifikator)) !!}                                                            
                                                    @endif
                                                `.trim()
                                            }" class="mt-1">
                                            <div class="p-2 bg-danger-lt rounded text-start text-danger border border-danger-subtle small shadow-sm" style="font-size: 0.8rem;">
                                                <div class="fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">
                                                    📌 Catatan dari {{ $data->dari_ajukan }}:
                                                </div>
                                                <div x-html="showFullText ? text : (text.length > 50 ? text.substring(0, 50) + '...' : text)" class="text-wrap"></div>
                                                <template x-if="text.length > 50">
                                                    <button @click="showFullText = !showFullText" class="btn btn-link p-0 text-danger font-weight-bold border-0 shadow-none text-decoration-none mt-1" style="font-size: 0.75rem;">
                                                        <span x-text="showFullText ? '▲ Sembunyikan' : '▼ Baca Selengkapnya'"></span>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>

                                    @elseif ($data->status_ajukan === 'spm ditolak')
                                        <div class="mb-1">
                                            <span class="badge bg-dark-lt text-dark fw-bold border px-2 py-1">
                                                SPM DITOLAK
                                            </span>
                                        </div>
                                        @if($data->catatan_admin)
                                        <div class="p-2 bg-dark-lt rounded text-start text-dark small border shadow-sm mt-1" style="font-size: 0.8rem;">
                                            <div class="fw-bold text-uppercase mb-1" style="font-size: 0.7rem;">Catatan Ditolak:</div>
                                            <div>{{ $data->catatan_admin }}</div>
                                        </div>
                                        @endif

                                    @elseif ($data->status_ajukan === 'sp2d terbit')
                                        <span class="badge bg-success-lt text-success fw-bold border border-success-subtle px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-1" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                            SP2D TERBIT
                                        </span>

                                    @elseif ($data->status_ajukan === 'draft')
                                        <span class="badge bg-secondary-lt text-secondary fw-bold border border-secondary-subtle px-2 py-1">
                                            DRAFT
                                        </span>

                                    @elseif ($data->status_ajukan === 'diajukan')
                                        <span class="badge bg-primary-lt text-primary fw-bold border border-primary-subtle px-2 py-1">
                                            DIUSULKAN
                                        </span>

                                    @elseif ($data->status_ajukan === 'verifikasi')
                                        <span class="badge bg-info-lt text-info fw-bold border border-info-subtle px-2 py-1">
                                            VERIFIKASI
                                        </span>

                                    @elseif ($data->status_ajukan === 'menunggu berkas asli')
                                        <span class="badge bg-warning-lt text-warning fw-bold border border-warning-subtle px-2 py-1">
                                            MENUNGGU BERKAS ASLI
                                        </span>

                                    @elseif ($data->status_ajukan === 'diproses')
                                        <span class="badge bg-azure-lt text-azure fw-bold border border-azure-subtle px-2 py-1">
                                            DIPROSES
                                        </span>

                                    @else
                                        <span class="badge bg-secondary-lt text-secondary fw-bold px-2 py-1">
                                            {{ strtoupper($data->status_ajukan) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-list flex-nowrap justify-content-end">
                                        @if ($data->status_ajukan === 'perlu perbaikan')
                                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Perbaiki SPM" wire:click="updateId('{{ $data->id }}')"
                                                class="btn btn-sm btn-icon btn-outline-info shadow-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>
                                        @else
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
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty">
                                        <div class="empty-icon text-muted mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
                                        </div>
                                        <p class="empty-title fw-bold text-dark mb-1">Tidak ada data SPM ditemukan</p>
                                        <p class="empty-subtitle text-muted small mb-3">
                                            @if($filter_status_spm !== 'semua' || $filter_jenis !== 'semua' || !empty($query))
                                                Tidak ada data SPM yang sesuai dengan filter atau kata kunci pencarian Anda.
                                            @else
                                                Belum ada data status SPM untuk instansi Anda.
                                            @endif
                                        </p>
                                        @if($filter_status_spm !== 'semua' || $filter_jenis !== 'semua' || !empty($query))
                                            <div>
                                                <button type="button" wire:click="resetFilter" class="btn btn-sm btn-outline-primary shadow-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                    </svg>
                                                    Reset Semua Filter
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="card-footer bg-white d-flex align-items-center justify-content-between py-3">
                    {{ $spms->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>