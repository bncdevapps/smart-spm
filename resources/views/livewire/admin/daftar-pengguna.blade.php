<div x-data="{ l: $wire.entangle('isOpen')}">
    <x-slot:title>
        Daftar Pengguna
        </x-slot>

        <button x-on:click="l = true" class="btn btn-primary  mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg> Tambah
        </button>

        {{-- MODAL --}}
        <div x-show="l">
            <div class="modal modal-blur" aria-modal="true" role="dialog" style="display: block;">
                <div class="modal-dialog modal-lg modal-dialog-centered " role="document"
                    {{-- x-on:click.outside="l = false" --}}>
                    <div class="modal-content border-primary">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {{ $updateMode ? 'Ubah Pengguna' : 'Tambah Pengguna' }}
                            </h5>
                            <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit="{{ $updateMode ? 'update' : 'store' }}">
                            <div class="modal-body">
                                <style>
                                    .modal-content .form-control, .modal-content .form-select {
                                        background-color: #ffffff !important;
                                        color: #0f172a !important;
                                        border: 1.5px solid #cbd5e1 !important;
                                        border-radius: 8px !important;
                                        padding: 0.6rem 0.85rem !important;
                                        font-size: 0.925rem !important;
                                    }
                                    .modal-content .form-control:focus, .modal-content .form-select:focus {
                                        border-color: #2563eb !important;
                                        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
                                    }
                                    .modal-content label.form-label {
                                        color: #1e293b !important;
                                        font-weight: 600 !important;
                                        margin-bottom: 0.35rem !important;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input wire:model="name" type="text" placeholder="Masukkan nama pengguna..."
                                                class="form-control @error('name') is-invalid @enderror">
                                            <x-input-error2 for="name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Instansi <span class="text-danger">*</span></label>
                                            <select wire:model="name_instansi"
                                                class="form-select @error('name_instansi') is-invalid @enderror">
                                                <option value="">Pilih Instansi...</option>
                                                @foreach ($instansis as $data )
                                                <option value="{{$data->nama}}">{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error2 for="name_instansi" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIP Pegawai (Username Login) <span class="text-danger">*</span></label>
                                            <input wire:model="username" type="text" placeholder="Masukkan NIP Pegawai..."
                                                class="form-control @error('username') is-invalid @enderror">
                                            <x-input-error2 for="username" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="form-label-description text-muted">(Opsional)</span></label>
                                            <input wire:model="email" type="email" placeholder="contoh@instansi.go.id (Opsional)"
                                                class="form-control @error('email') is-invalid @enderror">
                                            <x-input-error2 for="email" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Otorisasi / Peran <span class="text-danger">*</span></label>
                                            <select wire:model="otorisasi"
                                                class="form-select @error('otorisasi') is-invalid @enderror">
                                                <option value="">Pilih Otorisasi...</option>
                                                <option value="admin">Admin</option>
                                                <option value="bendahara">Bendahara</option>
                                                <option value="ppk">PPK</option>
                                                <option value="verifikator">Verifikator</option>
                                            </select>
                                            <x-input-error2 for="otorisasi" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="form-label-description text-muted">{{ $updateMode ? '(Opsional - kosongkan jika tidak diubah)' : '(Opsional)' }}</span></label>
                                            <input wire:model="password" type="password"
                                                placeholder="{{ $updateMode ? 'Kosongkan jika tidak diubah...' : 'Default: 12345678' }}"
                                                class="form-control @error('password') is-invalid @enderror">
                                            <x-input-error2 for="password" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan <span class="form-label-description text-muted">(Opsional)</span></label>
                                            <textarea wire:model="keterangan" placeholder="Keterangan tambahan (opsional)..."
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                rows="2"></textarea>
                                            <x-input-error2 for="keterangan" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-info border-0 shadow-sm" role="alert" style="border-radius: 10px; background-color: #eff6ff;">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 mt-1 text-blue">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon alert-icon">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h4 class="alert-title text-primary fw-bold mb-1">Informasi Akun:</h4>
                                                    <div class="text-secondary" style="font-size: 0.875rem;">
                                                        • Pengguna dapat masuk ke sistem menggunakan <strong>NIP Pegawai</strong>.<br>
                                                        @if ($updateMode)
                                                            • Jika kolom password dikosongkan, password pengguna tidak akan diubah.
                                                        @else
                                                            • Password default akun baru diset ke <strong>12345678</strong>.<br>
                                                            • Role <strong>Bendahara</strong> dan <strong>PPK</strong> wajib mengubah password bawaan saat login pertama kali dengan kombinasi karakter khusus, angka, serta huruf besar & kecil.
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        <div wire:loading wire:target='store'
                                            class="spinner-border spinner-border-sm  me-2 "></div>
                                        <div wire:loading wire:target='update'
                                            class="spinner-border spinner-border-sm  me-2 "></div>
                                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-row-insert-top">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 18v-4a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z" />
                                            <path d="M12 9v-4" />
                                            <path d="M10 7l4 0" />
                                        </svg>
                                        {{ $updateMode ? 'Simpan Perubahan' : 'Simpan' }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        {{-- END MODAL --}}

        <div class="col-12">
            <div class="row row-cards">




                {{-- TABEL --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                        <path d="M21 21l-6 -6"></path>
                                    </svg>
                                </span>
                                <input wire:model.live="query" type="search" class="form-control "
                                    placeholder="Cari Berdasarkan Nama atau NIP Pegawai..." />
                            </div>





                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable table-striped">
                                <thead>
                                    <tr>

                                        <th class="w-1">No.</th>
                                        <th>Nama Instansi</th>
                                        <th>Nama</th>
                                        <th>NIP Pegawai</th>
                                        <th>Email</th>
                                        <th>Otorisasi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $users as $key => $data )
                                    <tr wire:key="{{ $data->id }}">
                                        <td> {{ $users->firstItem() + $key }} </td>
                                        <td class="text-wrap"> {{$data->name_instansi}}</td>
                                        <td class="text-wrap"> {{$data->name}}</td>
                                        <td class="text-wrap"> {{$data->username}}</td>
                                        <td class="text-wrap"> {{$data->email}}</td>
                                        <td class="text-wrap"> {{$data->otorisasi}}</td>
                                        <td class="text-end">
                                            <button title="Hapus" wire:click="deleteId('{{ $data->id }}')"
                                                class="btn btn-danger btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                            <button title="Perbaiki" wire:click="updateId('{{ $data->id }}')"
                                                class="btn btn-info btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </button>



                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="text-center text-danger">
                                                Empty...
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer align-items-center">
                            {{ $users->onEachSide(0)->links() }}


                        </div>
                    </div>
                </div>

                {{-- END TABEL --}}
            </div>
        </div>
</div>