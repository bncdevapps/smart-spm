<div>
    <x-slot:title>
        Lembar Penguji
        </x-slot>

        <form wire:submit.prevent>
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row">



                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal SPM</label>
                                    <input wire:model="tanggal" type="date"
                                        class="form-control @error('tanggal') is-invalid @enderror">
                                    <x-input-error2 for="tanggal" />                               
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Instansi</label>
                                <select wire:model="instansi"
                                    class="form-select @error('instansi') is-invalid @enderror">
                                    <option selected="">Cari...</option>
                                    <hr>
                                    <option value="semua">Semua </option>
                                    @foreach ($instansis as $data )
                                    <option value="{{$data->nama}}">{{$data->nama}}</option>
                                    @endforeach

                                </select>
                                <x-input-error2 for="instansi" />
                            </div>
                        </div>

                           <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Cetak</label>
                                    <input wire:model="tanggal_cetak" type="date"
                                        class="form-control @error('tanggal_cetak') is-invalid @enderror">
                                    <x-input-error2 for="tanggal_cetak" />                               
                            </div>
                        </div>
                       

                    </div>



                </div>
                <div class="card-footer">
                    <div class="">
                        <button type="button" wire:loading.attr="disabled" 
                            wire:click='viewPreview' class="btn btn-secondary  m-2">
                            <div wire:loading wire:target='viewPreview' class="spinner-border spinner-border-sm me-2">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-table-down">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                                <path d="M3 10h18" />
                                <path d="M10 3v18" />
                                <path d="M19 16v6" />
                                <path d="M22 19l-3 3l-3 -3" />
                            </svg>
                            Preview
                        </button>
                        <button type="button" wire:loading.attr="disabled" wire:click='exportExcel'
                            class="btn btn-teal  m-2">
                            <div wire:loading wire:target='exportExcel' class="spinner-border spinner-border-sm me-2">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-spreadsheet">
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
                            class="btn btn-pinterest m-2">
                            <div wire:loading wire:target='exportPdf' class="spinner-border spinner-border-sm me-2">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                <path d="M17 18h2" />
                                <path d="M20 15h-3v6" />
                                <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                            </svg>
                            Export PDF
                        </button>
                    </div>

                    @if ($preview)
                    <h3 class="mt-3 border-top">Hasil Preview,</h3>
                        <div style="text-align: center;">
                            <h2>PEMERINTAH KABUPATEN TABALONG</h2>
                            <h3>DAFTAR PENGUJI</h3>
                            <p>Tanggal Cetak {{ \Carbon\Carbon::parse($tanggal_cetak)->format('d M Y') }}</p>
                        </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable table-striped">
                            <thead>
                                <tr>

                                    <th class="w-1">No.</th>                                     
                        <th>Nomor SP2D</th>
                        <th>Tanggal</th>
                        <th>Jenis SP2D</th>
                        <th>Bruto</th>
                        <th>Potongan</th>
                        <th>Netto</th>
                        <th>Nama SKPD</th>
                        <th class="text-wrap">Nama Pihak ke-3</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $spms as $key => $spm )
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $spm['nomor_sp2d'] }}</td>
                                    <td>{{ date('d M Y', strtotime($spm['tanggal'])) }}</td>
                                    <td>{{ $spm['jenis'] }}</td>
                                    <td>Rp{{ number_format($spm['jumlah'], 0, ',', '.'), }}</td>
                                    <td>Rp{{ number_format($spm['ppn'] + $spm['jumlah_pajak_lain'] + $spm['jumlah_potongan'], 0, ',', '.'), }}</td>
                                    <td>Rp{{ number_format($spm['jumlah_netto'], 0, ',', '.'), }}</td>
                                    <td>{{ $spm['instansi'] }}</td>
                                    <td>{{ $spm['penyedia'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="text-center text-danger">
                                            Empty...
                                        </div>
                                    </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>                    
                    @endif
                </div>
            </div>
        </form>
</div>