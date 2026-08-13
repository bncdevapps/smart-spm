<div x-data="{ l: $wire.entangle('isOpen')}">
    <x-slot:title>
        Penyedia / Rekanan
    </x-slot>

    {{-- MODAL --}}
    <div x-show="l" style="display: none;">
        <div class="modal modal-blur" aria-modal="true" role="dialog" style="display: block;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-primary shadow-lg">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            {{ $updateMode ? 'Ubah Data Penyedia / Rekanan' : 'Tambah Data Penyedia / Rekanan' }}
                        </h5>
                        <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form wire:submit="{{ $updateMode ? 'update' : 'store' }}">
                        <div class="modal-body">
                            {{-- SEKSI 1: DATA PENYEDIA --}}
                            <div class="card mb-3 border-secondary-subtle">
                                <div class="card-header bg-light py-2">
                                    <h4 class="card-title text-primary m-0 fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                                        Data Penyedia
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required fw-semibold">Nama Penyedia/Rekanan</label>
                                            <input wire:model="nama" type="text"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Contoh: PT. Maju Bersama">
                                            <x-input-error2 for="nama" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">NPWP</label>
                                            <input wire:model="npwp" type="text"
                                                class="form-control font-monospace @error('npwp') is-invalid @enderror"
                                                placeholder="Contoh: 01.234.567.8-901.000">
                                            <x-input-error2 for="npwp" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-semibold">Alamat</label>
                                            <textarea wire:model="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                rows="2" placeholder="Alamat lengkap penyedia"></textarea>
                                            <x-input-error2 for="alamat" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SEKSI 2: AKUN PEMBAYARAN --}}
                            <div class="card mb-2 border-secondary-subtle">
                                <div class="card-header bg-light py-2">
                                    <h4 class="card-title text-primary m-0 fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 10l9 -7l9 7v11a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                        Akun Pembayaran
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Nama Bank</label>
                                            <input wire:model="nama_bank" type="text"
                                                class="form-control @error('nama_bank') is-invalid @enderror"
                                                placeholder="Contoh: Bank Kalsel">
                                            <x-input-error2 for="nama_bank" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Nama Rekening</label>
                                            <input wire:model="nama_rekening" type="text"
                                                class="form-control @error('nama_rekening') is-invalid @enderror"
                                                placeholder="Nama Pemilik Rekening">
                                            <x-input-error2 for="nama_rekening" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Nomor Rekening</label>
                                            <input wire:model="nomor_rekening" type="text"
                                                class="form-control font-monospace @error('nomor_rekening') is-invalid @enderror"
                                                placeholder="Nomor Rekening Bank">
                                            <x-input-error2 for="nomor_rekening" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal()" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary ms-auto shadow-xs">
                                <div wire:loading wire:target='store' class="spinner-border spinner-border-sm me-2"></div>
                                <div wire:loading wire:target='update' class="spinner-border spinner-border-sm me-2"></div>
                                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-device-floppy me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                {{ $updateMode ? 'Simpan Perubahan' : 'Simpan Data' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL --}}

    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3">
            {{-- CARD HEADER --}}
            <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h3 class="card-title fw-bold text-dark m-0">Master Data Penyedia / Rekanan</h3>
                    <p class="text-muted small m-0">Kelola informasi perusahaan rekanan, NPWP, dan rekening bank transaksi</p>
                </div>
                <div>
                    <button x-on:click="l = true" class="btn btn-primary shadow-sm rounded-pill px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Tambah Penyedia / Rekanan
                    </button>
                </div>
            </div>

            {{-- SEARCH FILTER --}}
            <div class="card-body border-bottom bg-light-subtle py-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6 col-lg-5">
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
                            <input wire:model.live="query" type="search" class="form-control bg-white shadow-none"
                                placeholder="Cari Berdasarkan Nama, NPWP, Bank, atau No. Rekening..." />
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL PENYEDIA --}}
            <div class="table-responsive">
                <table class="table card-table table-vcenter table-hover text-nowrap datatable">
                    <thead class="bg-light">
                        <tr>
                            <th class="w-1 text-center">No.</th>
                            <th>Data Penyedia / Rekanan</th>
                            <th>NPWP</th>
                            <th>Akun Pembayaran</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penyedias as $key => $data)
                        <tr wire:key="{{ $data->id }}" class="transition-all">
                            <td class="text-center fw-medium text-muted">{{ $penyedias->firstItem() + $key }}</td>
                            <td class="text-wrap">
                                <div class="fw-bold text-dark fs-3 mb-1">{{ $data->nama }}</div>
                                @if($data->name_instansi)
                                    <div class="mb-1"><span class="badge bg-indigo-lt small" style="font-size: 0.75rem;">{{ $data->name_instansi }}</span></div>
                                @endif
                                @if($data->alamat)
                                    <div class="text-muted small">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin me-1" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                                        {{ $data->alamat }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($data->npwp)
                                    <span class="badge bg-blue-lt font-monospace px-2 py-1">{{ $data->npwp }}</span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-wrap">
                                @if($data->nama_bank || $data->nomor_rekening || $data->nama_rekening)
                                    <div class="small">
                                        <strong>Bank:</strong> <span class="badge bg-azure-lt text-uppercase ms-1">{{ $data->nama_bank ?: '-' }}</span>
                                    </div>
                                    <div class="small">
                                        <strong>No. Rek:</strong> <span class="fw-bold font-monospace text-dark ms-1">{{ $data->nomor_rekening ?: '-' }}</span>
                                    </div>
                                    <div class="text-muted small">a.n. {{ $data->nama_rekening ?: '-' }}</div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-list flex-nowrap justify-content-end">
                                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit / Perbaiki" wire:click="updateId('{{ $data->id }}')"
                                        class="btn btn-sm btn-icon btn-outline-info shadow-xs me-1">
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
                                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Penyedia" wire:click="deleteId('{{ $data->id }}')"
                                        class="btn btn-sm btn-icon btn-outline-danger shadow-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty">
                                    <div class="empty-icon text-muted mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
                                    </div>
                                    <p class="empty-title fw-bold text-dark mb-1">Belum ada data Penyedia / Rekanan</p>
                                    <p class="empty-subtitle text-muted small mb-0">Klik tombol "Tambah Penyedia / Rekanan" untuk mendaftarkan penyedia baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white d-flex align-items-center justify-content-between py-3">
                {{ $penyedias->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</div>
