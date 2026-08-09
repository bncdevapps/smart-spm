<?php

namespace App\Livewire\Bendahara;

use App\Models\JenisSpm;
use App\Models\Pajak;
use App\Models\Penyedia;
use App\Models\Potongan;
use App\Models\Spm;
use App\Rules\ValidJumlah;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;

class StatusSpm extends Component
{
    use WithFileUploads, WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $spmId;

    #[Url()]
    public $query = '';

    #[Url()]
    public $filter_status_spm = 'semua';

    #[Url()]
    public $filter_jenis = 'semua';

    public $isOpen = false;
    public $isRead = false;
    public $existingDokumen = [];
    public $tanggal, $nomor, $jenis, $jumlah, $penyedia, $keterangan, $status;
    public $dokumen = [];
    public $newDokumenUpload = [];

    public $notifKeterangan = '';
    public $keperluan, $npwp_bendahara, $kode_akun_pajak, $kode_jenis_setoran_pajak, $id_biling_pajak, $pajak_lain, $potongan;
    public $ppn, $jumlah_pajak_lain, $jumlah_potongan, $jumlah_netto;

    public $showPpn = false;
    public $id_biling_ppn = '';
    public $pajak_lain_items = [];
    public $potongan_items = [];
    public $selectedPenyediaObj = null;

    public $xjumlah_netto, $read_instansi;
    public $sp2d, $nomor_sp2d, $tanggal_pajak, $tanggal_bayar_pajak, $ntpn;
    public $read_status_ajukan, $read_dari_ajukan, $read_catatan_ppk, $read_catatan_verifikator, $read_catatan_admin;

    public function updatedFilterStatusSpm()
    {
        $this->resetPage();
    }

    public function updatedFilterJenis()
    {
        $this->resetPage();
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->query = '';
        $this->filter_status_spm = 'semua';
        $this->filter_jenis = 'semua';
        $this->resetPage();
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
        return (string) number_format((float) $value, 0, ',', '.');
    }

    public function togglePpn()
    {
        $this->showPpn = !$this->showPpn;
        if (!$this->showPpn) {
            $this->ppn = 0;
            $this->id_biling_ppn = '';
        }
        $this->hitungNetto();
    }

    public function addPajakLainItem()
    {
        $this->pajak_lain_items[] = [
            'jenis' => '',
            'jumlah' => 0,
            'id_biling' => '',
        ];
        $this->hitungNetto();
    }

    public function removePajakLainItem($index)
    {
        unset($this->pajak_lain_items[$index]);
        $this->pajak_lain_items = array_values($this->pajak_lain_items);
        $this->hitungNetto();
    }

    public function addPotonganItem()
    {
        $this->potongan_items[] = [
            'jenis' => '',
            'jumlah' => 0,
        ];
        $this->hitungNetto();
    }

    public function removePotonganItem($index)
    {
        unset($this->potongan_items[$index]);
        $this->potongan_items = array_values($this->potongan_items);
        $this->hitungNetto();
    }

    public function selectPenyedia($penyediaId)
    {
        $penyediaModel = Penyedia::find($penyediaId);
        if ($penyediaModel) {
            $this->penyedia = $penyediaModel->nama;
            $this->selectedPenyediaObj = [
                'nama' => $penyediaModel->nama,
                'alamat' => $penyediaModel->alamat,
                'npwp' => $penyediaModel->npwp,
                'nama_bank' => $penyediaModel->nama_bank,
                'nama_rekening' => $penyediaModel->nama_rekening,
                'nomor_rekening' => $penyediaModel->nomor_rekening,
            ];
        }
    }

    public function hitungNetto()
    {
        $valPpn = $this->showPpn ? $this->cleanNumber($this->ppn) : 0;

        $totalPajakLain = 0;
        if (!empty($this->pajak_lain_items) && is_array($this->pajak_lain_items)) {
            foreach ($this->pajak_lain_items as $item) {
                if (isset($item['jumlah'])) {
                    $totalPajakLain += $this->cleanNumber($item['jumlah']);
                }
            }
        }

        $totalPotongan = 0;
        if (!empty($this->potongan_items) && is_array($this->potongan_items)) {
            foreach ($this->potongan_items as $item) {
                if (isset($item['jumlah'])) {
                    $totalPotongan += $this->cleanNumber($item['jumlah']);
                }
            }
        }

        $valJumlah = $this->cleanNumber($this->jumlah);
        $xhasil = $valJumlah - ($valPpn + $totalPajakLain + $totalPotongan);
        $this->xjumlah_netto = $xhasil;
        $this->jumlah_netto = $this->rupiahNumber($xhasil);
        $this->jumlah_pajak_lain = $this->rupiahNumber($totalPajakLain);
        $this->jumlah_potongan = $this->rupiahNumber($totalPotongan);
    }

    public function updated($property = null)
    {
        $this->hitungNetto();
    }

    public function updatedJumlah($value)
    {
        $this->hitungNetto();
    }

    public function updatedPpn($value)
    {
        $this->hitungNetto();
    }

    public function updatedPajakLainItems()
    {
        $this->hitungNetto();
    }

    public function updatedPotonganItems()
    {
        $this->hitungNetto();
    }

    public function updatedNewDokumenUpload()
    {
        $this->validate([
            'newDokumenUpload.*' => 'file|mimes:pdf|max:10240',
        ]);

        if (!empty($this->newDokumenUpload)) {
            $uploads = is_array($this->newDokumenUpload) ? $this->newDokumenUpload : [$this->newDokumenUpload];
            foreach ($uploads as $file) {
                $this->dokumen[] = $file;
            }
        }

        $this->newDokumenUpload = [];
        $this->resetValidation('dokumen');
        $this->resetValidation('dokumen.*');
        $this->resetValidation('newDokumenUpload');
        $this->resetValidation('newDokumenUpload.*');
    }

    public function removeUploadDokumen()
    {
        $this->dokumen = [];
        $this->newDokumenUpload = [];
        $this->resetValidation('dokumen');
        $this->resetValidation('dokumen.*');
        $this->resetValidation('newDokumenUpload');
        $this->resetValidation('newDokumenUpload.*');
    }

    public function removeNewDokumen($index)
    {
        if (isset($this->dokumen[$index])) {
            unset($this->dokumen[$index]);
            $this->dokumen = array_values($this->dokumen);
        }
        $this->resetValidation('dokumen');
        $this->resetValidation('dokumen.*');
    }

    public function removeExistingDokumen($index)
    {
        if (isset($this->existingDokumen[$index])) {
            unset($this->existingDokumen[$index]);
            $this->existingDokumen = array_values($this->existingDokumen);
        }
        $this->resetValidation('dokumen');
    }

    public function updatedJenis($value)
    {
        $ket = JenisSpm::where('nama', $value)->first();
        if ($ket) {
            $this->notifKeterangan = $ket->keterangan;
        } else {
            $this->notifKeterangan = '-';
        }
    }

    public function readId($id)
    {
        $this->resetValidation();
        $spms = Spm::where('instansi', Auth()->user()->name_instansi)->findOrFail($id);
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

        $this->kode_akun_pajak = $spms->kode_akun_pajak;
        $this->kode_jenis_setoran_pajak = $spms->kode_jenis_setoran_pajak;
        $this->id_biling_pajak = $spms->id_biling_pajak;

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

        $this->sp2d = $spms->nomor_sp2d;
        $this->nomor_sp2d = $spms->nomor_sp2d;
        $this->tanggal_pajak = $spms->tanggal_bayar_pajak ? $spms->tanggal_bayar_pajak->format('d M Y') : '-';
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
        $this->resetExcept(['filter_status_spm', 'filter_jenis', 'query']);
        $this->resetValidation();
        $this->selectedPenyediaObj = null;
    }

    public function updateId($id)
    {
        $this->resetValidation();
        $spms = Spm::where('instansi', Auth()->user()->name_instansi)->findOrFail($id);
        $this->spmId = $id;
        $this->tanggal = $spms->tanggal->format('Y-m-d');
        $this->nomor = $spms->nomor;
        $this->jenis = $spms->jenis;
        $this->jumlah = $this->rupiahNumber($spms->jumlah);
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
            $this->selectedPenyediaObj = null;
        }

        $this->showPpn = ($spms->ppn > 0 || !empty($spms->id_biling_ppn));
        $this->id_biling_ppn = $spms->id_biling_ppn;
        $this->ppn = $this->rupiahNumber($spms->ppn);

        $this->pajak_lain_items = $spms->pajak_lain_items ?? [];
        $this->potongan_items = $spms->potongan_items ?? [];

        $this->hitungNetto();

        $this->existingDokumen = $spms->dokumen_list;
        $this->dokumen = [];
        $this->newDokumenUpload = [];
        $this->isOpen = true;
        $this->isRead = false;
    }

    protected function messages()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'string' => ':attribute harus berupa teks.',
            'dokumen.required' => 'Dokumen lampiran (PDF) wajib diunggah.',
            'dokumen.min' => 'Minimal harus mengunggah 1 dokumen lampiran.',
            'dokumen.*.file' => 'Berkas harus berupa file yang valid.',
            'dokumen.*.mimes' => 'Setiap berkas lampiran harus berupa file PDF.',
            'dokumen.*.max' => 'Ukuran masing-masing berkas tidak boleh lebih dari 10 MB.',
            'newDokumenUpload.*.file' => 'Berkas harus berupa file yang valid.',
            'newDokumenUpload.*.mimes' => 'Setiap berkas lampiran harus berupa file PDF.',
            'newDokumenUpload.*.max' => 'Ukuran masing-masing berkas tidak boleh lebih dari 10 MB.',
            'max' => [
                'string' => ':attribute tidak boleh lebih dari :max karakter.',
                'file' => 'Ukuran :attribute tidak boleh lebih dari :max KB.',
            ],
            'mimes' => ':attribute harus berupa file dengan format: :values.',
            'file' => ':attribute harus berupa sebuah file.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'tanggal' => 'Tanggal SPM',
            'nomor' => 'Nomor SPM',
            'jenis' => 'Jenis SPM',
            'jumlah' => 'Jumlah SPM (Bruto)',
            'penyedia' => 'Nama Pihak Ketiga/Penyedia',
            'keterangan' => 'Keterangan',
            'dokumen' => 'Dokumen Lampiran',
            'dokumen.*' => 'Berkas Lampiran',
            'newDokumenUpload' => 'Berkas Dokumen Lampiran',
            'newDokumenUpload.*' => 'Berkas Dokumen Lampiran',
            'keperluan' => 'Keperluan',
            'id_biling_ppn' => 'ID Billing PPN',
            'ppn' => 'PPN',
            'pajak_lain_items.*.jenis' => 'Jenis Pajak Lainnya',
            'pajak_lain_items.*.jumlah' => 'Nominal Pajak Lainnya',
            'pajak_lain_items.*.id_biling' => 'ID Billing Pajak Lainnya',
            'potongan_items.*.jenis' => 'Jenis Potongan',
            'potongan_items.*.jumlah' => 'Nominal Potongan',
            'jumlah_netto' => 'Jumlah SPM (Netto)',
        ];
    }

    public function UpdatePerbaikan()
    {
        $hasExisting = !empty($this->existingDokumen) && is_array($this->existingDokumen) && count($this->existingDokumen) > 0;
        $hasNew = !empty($this->dokumen) && is_array($this->dokumen) && count($this->dokumen) > 0;

        if (!$hasExisting && !$hasNew) {
            $this->addError('dokumen', 'Minimal harus ada 1 dokumen lampiran (PDF).');
            return;
        }

        $rules = [
            'tanggal' => 'required|date',
            'nomor' => 'required|string|max:255',
            'jenis' => 'required|string',
            'jumlah' => ['required', new ValidJumlah],
            'penyedia' => 'required|string',
            'keperluan' => 'required|string',
            'keterangan' => 'nullable|string',
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'file|mimes:pdf|max:10240',
        ];

        if ($this->showPpn) {
            $rules['ppn'] = ['required', new ValidJumlah];
            $rules['id_biling_ppn'] = 'nullable|string|max:255';
        }

        if (!empty($this->pajak_lain_items)) {
            foreach ($this->pajak_lain_items as $index => $item) {
                $rules['pajak_lain_items.' . $index . '.jenis'] = 'required|string';
                $rules['pajak_lain_items.' . $index . '.jumlah'] = ['required', new ValidJumlah];
                $rules['pajak_lain_items.' . $index . '.id_biling'] = 'nullable|string|max:255';
            }
        }

        if (!empty($this->potongan_items)) {
            foreach ($this->potongan_items as $index => $item) {
                $rules['potongan_items.' . $index . '.jenis'] = 'required|string';
                $rules['potongan_items.' . $index . '.jumlah'] = ['required', new ValidJumlah];
            }
        }

        $this->validate($rules);

        try {
            $spms = Spm::where('id', $this->spmId)
                ->where('status', 'diajukan')
                ->where('status_ajukan', 'perlu perbaikan')
                ->where('instansi', Auth()->user()->name_instansi)
                ->firstOrFail();

            $dokumenList = is_array($this->existingDokumen) ? $this->existingDokumen : [];
            if (!empty($this->dokumen) && is_array($this->dokumen)) {
                foreach ($this->dokumen as $file) {
                    $file->store(path: 'dokumens');
                    $dokumenList[] = [
                        'file' => $file->hashName(),
                        'nama' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                    ];
                }
            }

            // Hapus file fisik lama yang tidak lagi ada di existing list
            $originalDocs = $spms->dokumen_list;
            $keptFiles = array_column($dokumenList, 'file');
            foreach ($originalDocs as $old) {
                if (!empty($old['file']) && !in_array($old['file'], $keptFiles)) {
                    Storage::disk('local')->delete('dokumens/' . $old['file']);
                }
            }

            $valJumlah = $this->cleanNumber($this->jumlah);
            $valPpn = $this->showPpn ? $this->cleanNumber($this->ppn) : 0;

            $pajakLainClean = [];
            $totalPajakLain = 0;
            if (!empty($this->pajak_lain_items)) {
                foreach ($this->pajak_lain_items as $pItem) {
                    $jml = $this->cleanNumber($pItem['jumlah'] ?? 0);
                    $totalPajakLain += $jml;
                    $pajakLainClean[] = [
                        'jenis' => $pItem['jenis'] ?? '',
                        'jumlah' => $jml,
                        'id_biling' => $pItem['id_biling'] ?? '',
                    ];
                }
            }

            $potonganClean = [];
            $totalPotongan = 0;
            if (!empty($this->potongan_items)) {
                foreach ($this->potongan_items as $potItem) {
                    $jml = $this->cleanNumber($potItem['jumlah'] ?? 0);
                    $totalPotongan += $jml;
                    $potonganClean[] = [
                        'jenis' => $potItem['jenis'] ?? '',
                        'jumlah' => $jml,
                    ];
                }
            }

            $netto = $valJumlah - ($valPpn + $totalPajakLain + $totalPotongan);

            $updateData = [
                'tanggal' => $this->tanggal,
                'nomor' => $this->nomor,
                'jenis' => $this->jenis,
                'jumlah' => $valJumlah,
                'penyedia' => $this->penyedia,
                'keperluan' => $this->keperluan,
                'keterangan' => $this->keterangan,
                'dokumen' => json_encode(array_values($dokumenList)),
                'ppn' => $valPpn,
                'id_biling_ppn' => $this->showPpn ? $this->id_biling_ppn : null,
                'pajak_lain_items' => $pajakLainClean,
                'jumlah_pajak_lain' => $totalPajakLain,
                'potongan_items' => $potonganClean,
                'jumlah_potongan' => $totalPotongan,
                'jumlah_netto' => $netto,
            ];

            if ($spms->dari_ajukan === 'ppk') {
                $updateData['posisi_ajukan'] = 'ppk';
                $updateData['status_ajukan'] = 'diajukan';
            } else {
                $updateData['posisi_ajukan'] = 'verifikator';
                $updateData['status_ajukan'] = 'verifikasi';
            }

            $spms->update($updateData);

            $this->resetExcept(['filter_status_spm', 'filter_jenis', 'query']);
            $this->alert('success', 'Perbaikan Berhasil Dikirim Ke ' . strtoupper($spms->dari_ajukan));
        } catch (\Throwable $th) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $queryBuilder = Spm::where('instansi', Auth()->user()->name_instansi);

        // Filter Status SPM
        if ($this->filter_status_spm === 'draft') {
            $queryBuilder->where(function ($q) {
                $q->where('status_ajukan', 'draft')
                  ->orWhere('status', 'draft');
            });
        } elseif ($this->filter_status_spm !== 'semua' && !empty($this->filter_status_spm)) {
            $queryBuilder->where('status_ajukan', $this->filter_status_spm);
        }

        // Filter Jenis SPM
        if ($this->filter_jenis !== 'semua' && !empty($this->filter_jenis)) {
            $queryBuilder->where('jenis', $this->filter_jenis);
        }

        // Pencarian (Search Query)
        if (!empty(trim($this->query))) {
            $searchTerm = trim($this->query);
            $queryBuilder->where(function ($q) use ($searchTerm) {
                $q->where('nomor', 'like', '%' . $searchTerm . '%')
                  ->orWhere('penyedia', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis', 'like', '%' . $searchTerm . '%')
                  ->orWhere('keterangan', 'like', '%' . $searchTerm . '%')
                  ->orWhere('status_ajukan', 'like', '%' . $searchTerm . '%');
            });
        }

        $spms = $queryBuilder->orderBy('updated_at', 'desc')->paginate(10);
        $jenisspms = JenisSpm::orderBy('nama', 'asc')->get();
        $pajaks = Pajak::orderBy('nama', 'asc')->get();
        $potongans = Potongan::orderBy('nama', 'asc')->get();
        $penyedias = Penyedia::orderBy('nama', 'asc')->get();

        return view('livewire.bendahara.status-spm', [
            'spms' => $spms,
            'jenisspms' => $jenisspms,
            'pajaks' => $pajaks,
            'potongans' => $potongans,
            'penyedias' => $penyedias,
        ]);
    }
}

