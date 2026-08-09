<?php

namespace App\Livewire\Ppk;

use App\Models\Instansi;
use App\Models\Penyedia;
use App\Models\Spm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;

class IndexSpm extends Component
{
    use  WithPagination, WithoutUrlPagination, LivewireAlert;

    public $query;
    public $instansi = '';

    #[Locked]
    public $spmId;

    public $isOpen = false;
    public $isRead = false;

    public $existingDokumen,  $tanggal, $nomor, $jenis, $jumlah, $penyedia, $keterangan, $dokumen, $status;

    public $keperluan, $npwp_bendahara, $kode_akun_pajak, $kode_jenis_setoran_pajak, $id_biling_pajak, $pajak_lain, $potongan;
    public $ppn, $jumlah_pajak_lain, $jumlah_potongan, $jumlah_netto;

    public $showPpn = false;
    public $id_biling_ppn = '';
    public $pajak_lain_items = [];
    public $potongan_items = [];
    public $selectedPenyediaObj = null;

    public  $xjumlah_netto, $read_instansi, $filterStatus = '', $kode;
    public $nomor_sp2d, $tanggal_bayar_pajak, $ntpn;
    public $read_status_ajukan, $read_dari_ajukan, $read_catatan_ppk, $read_catatan_verifikator, $read_catatan_admin;

    protected $query_cari = [];

    public function mount($kode)
    {
        $this->kode = $kode;
    }


    private function cleanNumber($value)
    {
        if (is_null($value) || $value === '') {
            return 0.0;
        }

        if (is_int($value) || is_float($value)) {
            return (float) $value;
        }

        $clean = preg_replace('/[^\d]/', '', (string) $value);
        return $clean === '' ? 0.0 : (float) $clean;
    }
    private function rupiahNumber($value)
    {
        return (string) number_format($value, 0, ',', '.');
    }

    public function readId($id)
    {
        $this->resetValidation();
        if ($this->kode == 0 || $this->kode == 5) {
            $spms = Spm::where('instansi', Auth()->user()->name_instansi)->findOrFail($id);
        } else {
            $spms = Spm::findOrFail($id);
        }

        $this->tanggal = $spms->tanggal->format('d M Y');
        $this->nomor = $spms->nomor;
        $this->jenis = $spms->jenis;
        $this->jumlah = 'Rp. ' . $this->rupiahNumber($spms->jumlah);
        $this->penyedia = $spms->penyedia;
        $this->keterangan = $spms->keterangan;

        $this->keperluan = $spms->keperluan;
        $this->npwp_bendahara = $spms->npwp_bendahara;

        $penyediaModel = Penyedia::where('nama', $spms->penyedia)->first();
        if ($penyediaModel) {
            $this->selectedPenyediaObj = [
                'nama' => $penyediaModel->nama,
                'alamat' => $penyediaModel->alamat,
                'npwp' => $penyediaModel->npwp,
                'nama_bank' => $penyediaModel->nama_bank,
                'nama_rekening' => $penyediaModel->nama_rekening,
                'nomor_rekening' => $penyediaModel->nomor_rekening,
            ];
        } else {
            $this->selectedPenyediaObj = [
                'nama' => $spms->penyedia,
                'alamat' => '-',
                'npwp' => $spms->npwp_bendahara ?: '-',
                'nama_bank' => '-',
                'nama_rekening' => '-',
                'nomor_rekening' => '-',
            ];
        }

        $this->showPpn = ($spms->ppn > 0 || !empty($spms->id_biling_ppn));
        $this->id_biling_ppn = $spms->id_biling_ppn;
        $this->ppn = 'Rp. ' . $this->rupiahNumber($spms->ppn);

        $this->pajak_lain_items = $spms->pajak_lain_items ?? [];
        $this->pajak_lain = $spms->pajak_lain . ' Rp. ' . $this->rupiahNumber($spms->jumlah_pajak_lain);
        $this->jumlah_pajak_lain = $this->rupiahNumber($spms->jumlah_pajak_lain);

        $this->potongan_items = $spms->potongan_items ?? [];
        $this->potongan = $spms->potongan . ' Rp. ' . $this->rupiahNumber($spms->jumlah_potongan);
        $this->jumlah_potongan = $this->rupiahNumber($spms->jumlah_potongan);

        $this->jumlah_netto = 'Rp. ' . $this->rupiahNumber($spms->jumlah_netto);

        $this->nomor_sp2d = $spms->nomor_sp2d;
        $this->tanggal_bayar_pajak = $spms->tanggal_bayar_pajak ? $spms->tanggal_bayar_pajak->format('d M Y') : '-';
        $this->ntpn = $spms->ntpn;

        $this->read_instansi = $spms->instansi;
        $this->read_status_ajukan = $spms->status_ajukan;
        $this->read_dari_ajukan = $spms->dari_ajukan;
        $this->read_catatan_ppk = $spms->catatan_ppk;
        $this->read_catatan_verifikator = $spms->catatan_verifikator;
        $this->read_catatan_admin = $spms->catatan_admin;

        $this->existingDokumen = $spms->dokumen_list;
        $this->isOpen = true;
        $this->isRead = true;
    }

    public function closeModal()
    {
        // $this->reset();
        $this->resetExcept(['filterStatus', 'kode']);
        $this->resetValidation();
    }

    protected $listeners = [
        'confirmedsetuju',
        'confirmedperbaiki',
    ];

    public function setujiId($id)
    {
        if (Auth::user()->otorisasi === 'admin') {
            $xpesan = 'Setujui dan Terbitkan SP2D?';
        } elseif (Auth::user()->otorisasi === 'ppk') {
            $xpesan = 'Setujui SPM dan teruskan ke Verifikator?';
        } else {
            if ($this->filterStatus == 'verifikasi') {
                $xpesan = 'Setujui SPM dan Tunggu Berkas Asli?';
            } else {
                $xpesan = 'Setujui SPM dan teruskan ke Admin?';
            }
        }
        $this->spmId = $id;

        if (Auth::user()->otorisasi === 'admin') {
            $this->alert('question', $xpesan, [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Ya, Terbitkan.',
                'onConfirmed' => 'confirmedsetuju',
                'showCancelButton' => true,
                'confirmButtonColor' => '#0054A6',
                'position' => 'center',
                'timer' => null,
                'input' => 'text',
                'inputPlaceholder' => 'Masukkan Nomor SP2D Disini',
                'width' => '42em',
                'inputValidator' => '(value) => !value ? "Nomor SP2D tidak boleh kosong!" : undefined',
            ]);
        } else {
            if ($this->kode == 5) {
                $this->alert('question', 'Input Data Pajak SP2D', [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Simpan',
                    'onConfirmed' => 'confirmedsetuju',
                    'showCancelButton' => true,
                    'cancelButtonText' => 'Batal',
                    'confirmButtonColor' => '#0054A6',
                    'position' => 'center',
                    'timer' => null,
                    'width' => '30em',
                    'html' => '
                           <p class="text-muted small mb-3">Silakan isi NTPN dan tanggal bayar pajak untuk SP2D ini.</p>
                           <div class="mb-3">
                                <label class="form-label fw-bold">NTPN</label>
                                <input id="ntpn" name="ntpn" type="text" class="form-control" placeholder="Masukkan nomor NTPN">                                            
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Bayar Pajak</label>
                                <input id="tanggal_bayar_pajak" name="tanggal_bayar_pajak" type="date" class="form-control">
                            </div>
                           
                    ',
                    'preConfirm' => "() => {
                        const ntpn = document.getElementById('ntpn').value;
                        const tanggal = document.getElementById('tanggal_bayar_pajak').value;
                        
                        if (!ntpn) {
                            Swal.showValidationMessage('NTPN tidak boleh kosong');
                            return false;
                        }
                        if (!tanggal) {
                            Swal.showValidationMessage('Tanggal bayar pajak belum diisi');
                            return false;
                        }
                        
                        return [ntpn, tanggal];
                    }",
                ]);
            } else {
                $this->alert('question', $xpesan, [
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Ya, Setujui. ',
                    'onConfirmed' => 'confirmedsetuju',
                    'showCancelButton' => true,
                    'confirmButtonColor' => '#0054A6',
                    'position' => 'center',
                    'timer' => null,
                ]);
            }
        }
    }

    private function generateNomorRegister(): string
    {
        $last = Spm::max('nomor_register');
        $next = $last ? ((int) $last) + 1 : 1;

        return str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function confirmedsetuju($value)
    {
        // dd($value[0]);

        try {

            $query = Spm::where('id', $this->spmId)
                ->where('status', 'diajukan')
                // ->where('status_ajukan', 'diajukan')
                ->where('posisi_ajukan', Auth::user()->otorisasi);



            if ($this->kode == 0 || $this->kode == 5) {
                $query->where('instansi', Auth()->user()->name_instansi);
            }

            $spms = $query->firstOrFail();
            // $spms = Spm::where('id', $this->spmId)
            //     ->where('status', 'diajukan')
            //     // ->where('status_ajukan', 'diajukan')
            //     ->where('posisi_ajukan', Auth::user()->otorisasi)
            //     ->firstOrFail();

            $ipesan = "Sukses";

            if (Auth::user()->otorisasi === 'admin') {
                $updateTujuan = [
                    'posisi_ajukan' => 'bendahara',
                    'status_ajukan' => 'sp2d terbit',
                    'nomor_sp2d' => $value,
                ];
                $ipesan = "SPM sudah diteruskan ke Bendahara";
            } elseif (Auth::user()->otorisasi === 'ppk') {
                $updateTujuan = [
                    'posisi_ajukan' => 'verifikator',
                    'status_ajukan' => 'verifikasi',
                ];
                $ipesan = "SPM sudah diteruskan ke Verifikator";
            } elseif (Auth::user()->otorisasi === 'verifikator') {
                if ($this->kode == 1) {
                    $updateTujuan = [
                        'nomor_register' => $this->generateNomorRegister(),
                        'posisi_ajukan' => 'verifikator',
                        'status_ajukan' => 'menunggu berkas asli',
                    ];
                    $ipesan = "SPM berhasil di Verifikasi";
                } else {
                    $updateTujuan = [
                        'posisi_ajukan' => 'admin',
                        'status_ajukan' => 'diproses',
                    ];
                    $ipesan = "SPM sudah diteruskan ke Admin";
                }
            } else {
                //Bendahara
                if ($this->kode == 5) {
                    $updateTujuan = [
                        'ntpn' => $value[0],
                        'tanggal_bayar_pajak' => $value[1],
                    ];
                }
                $ipesan = "NTPN dan Tanggal Bayar Pajak Berhasil Diperbarui";
            }

            $updateTujuan['dari_ajukan'] = Auth::user()->otorisasi;

            $spms->update($updateTujuan);

            // $spms->update([
            //     'dari_ajukan' => Auth::user()->otorisasi,
            //     $updateTujuan,
            //     // 'posisi_ajukan' => 'verikator',
            //     // 'status_ajukan' => 'verifikasi',
            // ]);

            // $this->reset();
            $this->resetExcept(['filterStatus', 'kode']);
            $this->alert('success', $ipesan);
            // $this->alert('success', 'SPM sudah diteruskan ke ' . $updateTujuan['posisi_ajukan']);
        } catch (\Exception $e) {
            dd($e);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function perbaikanId($id)
    {
        $this->spmId = $id;
        if (Auth::user()->otorisasi === 'admin') {
            $xStatusAJukan = 'SPM Ditolak';
        } else {
            $xStatusAJukan = 'Perlu Perbaikan SPM';
        }
        $this->alert('question', "$xStatusAJukan dan kembalikan ke Bendahara?", [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Kembalikan.',
            'onConfirmed' => 'confirmedperbaiki',
            'showCancelButton' => true,
            'confirmButtonColor' => '#D63939',
            'position' => 'center',
            'timer' => null,
            'input' => 'textarea',
            'inputLabel' => 'Catatan',
            'inputPlaceholder' => 'Empty...',
            'width' => '42em',
            'inputValidator' => '(value) => !value ? "Catatan tidak boleh kosong!" : undefined',
        ]);
    }
    public function confirmedperbaiki($value)
    {
        try {

            $query = Spm::where('id', $this->spmId)
                ->where('status', 'diajukan')
                ->where('posisi_ajukan', Auth::user()->otorisasi);



            if ($this->kode == 0 || $this->kode == 5) {
                $query->where('instansi', Auth()->user()->name_instansi);
            }

            $spms = $query->firstOrFail();
            // $spms = Spm::where('id', $this->spmId)
            //     ->where('status', 'diajukan')
            //     ->where('posisi_ajukan', Auth::user()->otorisasi)
            //     ->firstOrFail();

            $ctt = 'catatan_' . Auth::user()->otorisasi;
            if (Auth::user()->otorisasi === 'admin') {
                $xStatusAJukan = 'spm ditolak';
            } else {
                $xStatusAJukan = 'perlu perbaikan';
            }
            $spms->update([
                'dari_ajukan' => Auth::user()->otorisasi,
                'posisi_ajukan' => 'bendahara',
                'status_ajukan' => $xStatusAJukan, //'perlu perbaikan',
                $ctt => $value,
            ]);

            // $this->reset();
            $this->resetExcept(['filterStatus', 'kode']);
            $this->alert('success', 'SPM Sudah Dikembalikan ke Bendahara.');
        } catch (\Exception $e) {
            dd($e);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }




    public function render()
    {

        $query = Spm::select();

        if ($this->kode == 0) {
            (Auth::user()->otorisasi == 'ppk') ? $this->filterStatus = 'diajukan' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'jenis',
                'penyedia',
            ];
            $query->where('instansi', Auth()->user()->name_instansi);
        } elseif ($this->kode == 1) {
            (Auth::user()->otorisasi == 'verifikator') ? $this->filterStatus = 'verifikasi' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'jenis',
                'penyedia',
            ];
        } elseif ($this->kode == 2) {
            (Auth::user()->otorisasi == 'verifikator') ? $this->filterStatus = 'menunggu berkas asli' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'jenis',
                'penyedia',
            ];
        } elseif ($this->kode == 3) {
            (Auth::user()->otorisasi == 'admin') ? $this->filterStatus = 'menunggu berkas asli' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'jenis',
                'penyedia',
            ];
        } elseif ($this->kode == 4) {
            (Auth::user()->otorisasi == 'admin') ? $this->filterStatus = 'diproses' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'jenis',
                'penyedia',
            ];
        } elseif ($this->kode == 5) {
            (Auth::user()->otorisasi == 'bendahara') ? $this->filterStatus = 'sp2d terbit' : abort(403, 'Unauthorized');
            $this->query_cari = [
                'nomor',
                'nomor_sp2d',
                'penyedia',
            ];
            $query->where('instansi', Auth()->user()->name_instansi);
        } else {
            abort(403, 'Unauthorized');
        }



        if ($this->instansi != '') {
            $query->where('penyedia', $this->instansi);
        }

        $query->where('status_ajukan', $this->filterStatus);

        if ($this->kode == 3) {
            $query->where('posisi_ajukan', 'verifikator');
        } else {
            $query->where('posisi_ajukan', Auth::user()->otorisasi);
        }

        $query->where('status', 'diajukan')
            ->whereAny($this->query_cari, 'like', '%' . $this->query . '%');


        $query->orderBy('updated_at', 'desc');

        // dd($query->toSql());
        $spms = $query->paginate(5);
        $instansis = Instansi::orderBy('nama', 'asc')->get();

        return view('livewire.ppk.index-spm', [
            'spms' => $spms,
            'instansis' => $instansis,
        ]);
    }
}
 