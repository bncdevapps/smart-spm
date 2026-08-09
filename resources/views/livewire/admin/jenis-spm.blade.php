<div x-data="{ l: $wire.entangle('isOpen')}">
    <x-slot:title>
        Jenis SPM
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
                                {{ $updateMode ? 'Ubah Jenis SPM' : 'Tambah Jenis SPM' }}
                            </h5>
                            <button wire:click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit="{{ $updateMode ? 'update' : 'store' }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input wire:model="nama" type="text"
                                                class="form-control @error('nama') is-invalid @enderror">
                                            <x-input-error2 for="nama" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Kelengkapan Berkas yang Diupload</label>
                                            <textarea wire:model="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                rows="3"></textarea>
                                            <x-input-error2 for="keterangan" />
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
                                    placeholder="Cari Berdasarkan Nama" />
                            </div>





                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable table-striped">
                                <thead>
                                    <tr>

                                        <th class="w-1">No.</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $jenisspms as $key => $data )
                                    <tr wire:key="{{ $data->id }}">
                                        <td> {{ $jenisspms->firstItem() + $key }} </td>
                                        <td class="text-wrap"> {{$data->nama}}</td>
                                        <td class="text-wrap"> {!! nl2br($data->keterangan)!!}</td>
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
                                        <td colspan="4">
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
                            {{ $jenisspms->onEachSide(0)->links() }}


                        </div>
                    </div>
                </div>

                {{-- END TABEL --}}
            </div>
        </div>
</div>