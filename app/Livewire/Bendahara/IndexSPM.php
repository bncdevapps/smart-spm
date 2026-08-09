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
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class IndexSPM extends Component
{

    use WithFileUploads, WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $spmId;

    public $isOpen = false;
    public $isRead = false;
    public $updateMode = false;

    public $isAjukan = false;

    public $existingDokumen = [];
    public $query, $tanggal, $nomor, $jenis, $jumlah, $penyedia, $keterangan, $status;
    public $dokumen = [];
    public $newDokumenUpload = [];
    public $notifKeterangan = '';
    public $keperluan, $npwp_bendahara, $kode_akun_pajak, $kode_jenis_setoran_pajak, $id_biling_pajak, $pajak_lain, $potongan;
    public $ppn, $jumlah_pajak_lain, $jumlah_potongan, $jumlah_netto;
    public $xjumlah_netto, $read_instansi;
    public $nomor_sp2d, $tanggal_bayar_pajak, $ntpn, $read_status_ajukan, $read_dari_ajukan, $read_catatan_ppk, $read_catatan_verifikator, $read_catatan_admin;

    public $showPpn = false;
    public $id_biling_ppn = '';
    public $pajak_lain_items = [];
    public $potongan_items = [];
    public $selectedPenyediaObj = null;

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

    public function updatedJenis($value)
    {
        $ket = JenisSpm::where('nama', $value)->first();
        if ($ket) {
            $this->notifKeterangan = $ket->keterangan;
        } else {
            $this->notifKeterangan = '-';
        }
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
            'npwp_bendahara' => 'NPWP Bendahara/Rekanan',
            'kode_akun_pajak' => 'Kode Akun Pajak',
            'kode_jenis_setoran_pajak' => 'Kode Jenis Setoran Pajak',
            'id_biling_pajak' => 'ID Billing Pajak',
            'id_biling_ppn' => 'ID Billing PPN',
            'ppn' => 'PPN',
            'potongan' => 'Potongan',
            'jumlah_potongan' => 'Jumlah Potongan',
            'jumlah_netto' => 'Jumlah SPM (Netto)',
        ];
    }

    public function draft()
    {
        $validatedData = $this->validate(
            [
                'tanggal' => 'required|date',
                'nomor' => 'required|string|max:255',
                'jenis' => 'required|string',
                'jumlah' => ['required', new ValidJumlah],
                'penyedia' => 'required|string',
                'keterangan' => 'nullable|string',
                'dokumen' => 'required|array|min:1',
                'dokumen.*' => 'file|mimes:pdf|max:10240',
                'keperluan' => 'required|string',
                'npwp_bendahara' => 'nullable|string',
                'kode_akun_pajak' => 'nullable|string',
                'kode_jenis_setoran_pajak' => 'nullable|string',
                'id_biling_pajak' => 'nullable|string',
                'ppn' => [new ValidJumlah],
                'id_biling_ppn' => 'nullable|string',
                'pajak_lain_items' => 'nullable|array',
                'pajak_lain_items.*.jenis' => 'nullable|string',
                'pajak_lain_items.*.jumlah' => 'nullable',
                'pajak_lain_items.*.id_biling' => 'nullable|string',
                'potongan_items' => 'nullable|array',
                'potongan_items.*.jenis' => 'nullable|string',
                'potongan_items.*.jumlah' => 'nullable',
                'potongan' => 'nullable|string',
                'jumlah_potongan' => 'nullable',
                'jumlah_netto' => ['required', new ValidJumlah],
            ]
        );

        try {
            $dokumenList = [];
            if (!empty($this->dokumen) && is_array($this->dokumen)) {
                foreach ($this->dokumen as $file) {
                    $file->store(path: 'dokumens');
                    $dokumenList[] = [
                        'file' => $file->hashName(),
                        'nama' => Spm::cleanDocumentName($file->getClientOriginalName()),
                        'size' => $file->getSize(),
                    ];
                }
            }

            $validatedData['dokumen'] = json_encode($dokumenList);
            $validatedData['status'] = 'draft';                
            $validatedData['status_ajukan'] = 'draft';
            $validatedData['posisi_ajukan'] = 'bendahara';
            $validatedData['dari_ajukan'] = 'bendahara';
            $validatedData['instansi'] = Auth()->user()->name_instansi;

            $validatedData['ppn'] = $this->showPpn ? $this->cleanNumber($this->ppn) : 0;
            $validatedData['id_biling_ppn'] = $this->showPpn ? $this->id_biling_ppn : null;

            $cleanItems = [];
            $totalPajakLain = 0;
            $summaryNames = [];
            if (!empty($this->pajak_lain_items) && is_array($this->pajak_lain_items)) {
                foreach ($this->pajak_lain_items as $item) {
                    $itemJumlah = isset($item['jumlah']) ? $this->cleanNumber($item['jumlah']) : 0;
                    $totalPajakLain += $itemJumlah;
                    $cleanItems[] = [
                        'jenis' => $item['jenis'] ?? '',
                        'jumlah' => $itemJumlah,
                        'id_biling' => $item['id_biling'] ?? '',
                    ];
                    if (!empty($item['jenis'])) {
                        $summaryNames[] = $item['jenis'];
                    }
                }
            }
            $validatedData['pajak_lain_items'] = $cleanItems;
            $validatedData['jumlah_pajak_lain'] = $totalPajakLain;
            $validatedData['pajak_lain'] = !empty($summaryNames) ? implode(', ', $summaryNames) : '-';

            $cleanPotonganItems = [];
            $totalPotongan = 0;
            $summaryPotonganNames = [];
            if (!empty($this->potongan_items) && is_array($this->potongan_items)) {
                foreach ($this->potongan_items as $item) {
                    $itemJumlah = isset($item['jumlah']) ? $this->cleanNumber($item['jumlah']) : 0;
                    $totalPotongan += $itemJumlah;
                    $cleanPotonganItems[] = [
                        'jenis' => $item['jenis'] ?? '',
                        'jumlah' => $itemJumlah,
                    ];
                    if (!empty($item['jenis'])) {
                        $summaryPotonganNames[] = $item['jenis'];
                    }
                }
            }
            $validatedData['potongan_items'] = $cleanPotonganItems;
            $validatedData['jumlah_potongan'] = $totalPotongan;
            $validatedData['potongan'] = !empty($summaryPotonganNames) ? implode(', ', $summaryPotonganNames) : '-';

            $validatedData['id_biling_pajak'] = $this->id_biling_pajak ?: null;

            $jumlahBruto = $this->cleanNumber($this->jumlah);
            $validatedData['jumlah_netto'] = $jumlahBruto - ($validatedData['ppn'] + $totalPajakLain + $totalPotongan);

            Spm::create($validatedData);
            $this->reset();
            $this->alert('success', 'Draft SPM Berhasil Disimpan');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Error saving SPM draft: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            $this->alert('error', 'Gagal menyimpan SPM: ' . $th->getMessage());
            return;
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

        $this->read_instansi = $spms->instansi;

        $this->nomor_sp2d = $spms->nomor_sp2d;
        $this->tanggal_bayar_pajak = $spms->tanggal_bayar_pajak ? $spms->tanggal_bayar_pajak->format('d M Y') : '-';
        $this->ntpn = $spms->ntpn;
        $this->read_status_ajukan = $spms->status_ajukan;
        $this->read_dari_ajukan = $spms->dari_ajukan;
        $this->read_catatan_ppk = $spms->catatan_ppk;
        $this->read_catatan_verifikator = $spms->catatan_verifikator;
        $this->read_catatan_admin = $spms->catatan_admin;

        $this->existingDokumen = $spms->dokumen_list;
        $this->isOpen = true;
        $this->isRead = true;
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
        $this->ppn = $this->rupiahNumber($spms->ppn);

        $items = $spms->pajak_lain_items ?? [];
        if (is_array($items)) {
            foreach ($items as &$item) {
                if (isset($item['jumlah'])) {
                    $item['jumlah'] = $this->rupiahNumber($item['jumlah']);
                }
            }
        }
        $this->pajak_lain_items = $items;
        $this->pajak_lain = $spms->pajak_lain;
        $this->jumlah_pajak_lain = $this->rupiahNumber($spms->jumlah_pajak_lain);

        $potItems = $spms->potongan_items ?? [];
        if (is_array($potItems)) {
            foreach ($potItems as &$pItem) {
                if (isset($pItem['jumlah'])) {
                    $pItem['jumlah'] = $this->rupiahNumber($pItem['jumlah']);
                }
            }
        }
        $this->potongan_items = $potItems;
        $this->potongan = $spms->potongan;
        $this->jumlah_potongan = $this->rupiahNumber($spms->jumlah_potongan);

        $this->jumlah_netto = $this->rupiahNumber($spms->jumlah_netto);
        $this->xjumlah_netto = $spms->jumlah_netto;

        $this->existingDokumen = $spms->dokumen_list;
        $this->dokumen = [];
        $this->newDokumenUpload = [];
        $this->updateMode = true;
        $this->isOpen = true;
    }

    public function draftUpdate()
    {
        $hasExisting = !empty($this->existingDokumen) && is_array($this->existingDokumen) && count($this->existingDokumen) > 0;
        $hasNew = !empty($this->dokumen) && is_array($this->dokumen) && count($this->dokumen) > 0;

        if (!$hasExisting && !$hasNew) {
            $this->addError('dokumen', 'Minimal harus ada 1 dokumen lampiran (PDF).');
            return;
        }

        $validatedData = $this->validate(
            [
                'tanggal' => 'required|date',
                'nomor' => 'required|string|max:255',
                'jenis' => 'required|string',
                'jumlah' => ['required', new ValidJumlah],
                'penyedia' => 'required|string',
                'keterangan' => 'nullable|string',
                'dokumen' => 'nullable|array',
                'dokumen.*' => 'file|mimes:pdf|max:10240',
                'keperluan' => 'required|string',
                'npwp_bendahara' => 'nullable|string',
                'kode_akun_pajak' => 'nullable|string',
                'kode_jenis_setoran_pajak' => 'nullable|string',
                'id_biling_pajak' => 'nullable|string',
                'ppn' => [new ValidJumlah],
                'id_biling_ppn' => 'nullable|string',
                'pajak_lain_items' => 'nullable|array',
                'pajak_lain_items.*.jenis' => 'nullable|string',
                'pajak_lain_items.*.jumlah' => 'nullable',
                'pajak_lain_items.*.id_biling' => 'nullable|string',
                'potongan_items' => 'nullable|array',
                'potongan_items.*.jenis' => 'nullable|string',
                'potongan_items.*.jumlah' => 'nullable',
                'potongan' => 'nullable|string',
                'jumlah_potongan' => 'nullable',
                'jumlah_netto' => ['required', new ValidJumlah],
            ]
        );
        try {
            $spms = Spm::where('id', $this->spmId)
                ->where(function ($q) {
                    $q->where('status', 'draft')
                      ->orWhere('status_ajukan', 'perlu perbaikan');
                })
                ->where('instansi', Auth()->user()->name_instansi)
                ->firstOrFail();

            $dokumenList = is_array($this->existingDokumen) ? $this->existingDokumen : [];
            if (!empty($this->dokumen) && is_array($this->dokumen)) {
                foreach ($this->dokumen as $file) {
                    $file->store(path: 'dokumens');
                    $dokumenList[] = [
                        'file' => $file->hashName(),
                        'nama' => Spm::cleanDocumentName($file->getClientOriginalName()),
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

            $validatedData['dokumen'] = json_encode(array_values($dokumenList));

            $validatedData['ppn'] = $this->showPpn ? $this->cleanNumber($this->ppn) : 0;
            $validatedData['id_biling_ppn'] = $this->showPpn ? $this->id_biling_ppn : null;

            $cleanItems = [];
            $totalPajakLain = 0;
            $summaryNames = [];
            if (!empty($this->pajak_lain_items) && is_array($this->pajak_lain_items)) {
                foreach ($this->pajak_lain_items as $item) {
                    $itemJumlah = isset($item['jumlah']) ? $this->cleanNumber($item['jumlah']) : 0;
                    $totalPajakLain += $itemJumlah;
                    $cleanItems[] = [
                        'jenis' => $item['jenis'] ?? '',
                        'jumlah' => $itemJumlah,
                        'id_biling' => $item['id_biling'] ?? '',
                    ];
                    if (!empty($item['jenis'])) {
                        $summaryNames[] = $item['jenis'];
                    }
                }
            }
            $validatedData['pajak_lain_items'] = $cleanItems;
            $validatedData['jumlah_pajak_lain'] = $totalPajakLain;
            $validatedData['pajak_lain'] = !empty($summaryNames) ? implode(', ', $summaryNames) : '-';

            $cleanPotonganItems = [];
            $totalPotongan = 0;
            $summaryPotonganNames = [];
            if (!empty($this->potongan_items) && is_array($this->potongan_items)) {
                foreach ($this->potongan_items as $item) {
                    $itemJumlah = isset($item['jumlah']) ? $this->cleanNumber($item['jumlah']) : 0;
                    $totalPotongan += $itemJumlah;
                    $cleanPotonganItems[] = [
                        'jenis' => $item['jenis'] ?? '',
                        'jumlah' => $itemJumlah,
                    ];
                    if (!empty($item['jenis'])) {
                        $summaryPotonganNames[] = $item['jenis'];
                    }
                }
            }
            $validatedData['potongan_items'] = $cleanPotonganItems;
            $validatedData['jumlah_potongan'] = $totalPotongan;
            $validatedData['potongan'] = !empty($summaryPotonganNames) ? implode(', ', $summaryPotonganNames) : '-';

            $validatedData['id_biling_pajak'] = $this->id_biling_pajak ?: null;

            $jumlahBruto = $this->cleanNumber($this->jumlah);
            $validatedData['jumlah_netto'] = $jumlahBruto - ($validatedData['ppn'] + $totalPajakLain + $totalPotongan);

            $spms->update($validatedData);

            $this->reset();
            $this->alert('success', 'Perubahan SPM Berhasil Disimpan.');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Error updating SPM: ' . $th->getMessage(), ['trace' => $th->getTraceAsString()]);
            $this->alert('error', 'Gagal mengubah SPM: ' . $th->getMessage());
            return;
        }
    }

    public function ajukanId($id)
    {
        $this->spmId = $id;
        $this->alert('question', 'Usulkan SPM?', [
            'text' => 'SPM yang diusulkan akan diteruskan untuk diverifikasi kembali.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Usulkan!',
            'onConfirmed' => 'confirmedAjukan',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'confirmButtonColor' => '#206bc4',
            'position' => 'center',
            'timer' => 10000,
        ]);
    }

    public function confirmedAjukan()
    {
        try {
            $spm = Spm::where('id', $this->spmId)
                ->where(function ($q) {
                    $q->where('status', 'draft')
                      ->orWhere('status_ajukan', 'perlu perbaikan');
                })
                ->where('instansi', Auth()->user()->name_instansi)
                ->firstOrFail();

            if ($spm->status_ajukan === 'perlu perbaikan') {
                if ($spm->dari_ajukan === 'verifikator') {
                    $posisi = 'verifikator';
                    $statusAjukan = 'verifikasi';
                } else {
                    $posisi = 'ppk';
                    $statusAjukan = 'diajukan';
                }
            } else {
                $posisi = 'ppk';
                $statusAjukan = 'diajukan';
            }

            $spm->update([
                'status' => 'diajukan',
                'status_ajukan' => $statusAjukan,
                'posisi_ajukan' => $posisi,
            ]);

            $this->reset();
            $this->alert('success', 'SPM Berhasil Diusulkan');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Error mengusulkan SPM: ' . $th->getMessage());
            $this->alert('error', 'Gagal mengusulkan SPM.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->spmId = $id;
        $this->alert('question', 'Hapus Data Terpilih?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus! ',
            'onConfirmed' => 'confirmedhapus',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'confirmButtonColor' => '#D63939',
            'position' => 'center',
            'timer' => 5000,
        ]);
    }

    protected $listeners = [
        'confirmedhapus',
        'confirmedAjukan',
    ];

    public function confirmedhapus()
    {
        try {
            Spm::where('id', $this->spmId)
                ->where(function ($q) {
                    $q->where('status', 'draft')
                      ->orWhere('status_ajukan', 'perlu perbaikan');
                })
                ->where('instansi', Auth()->user()->name_instansi)
                ->delete();
            $this->reset();
            $this->alert('success', 'Hapus SPM Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function selectPenyedia($id)
    {
        $penyediaModel = Penyedia::find($id);
        if ($penyediaModel) {
            $this->penyedia = $penyediaModel->nama;
            $this->npwp_bendahara = $penyediaModel->npwp;
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

    public function render()
    {
        $this->hitungNetto();

        $spms = Spm::select()
            ->whereAny([
                'nomor',
                'penyedia',
                'jenis',
                'status',
                'status_ajukan',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->where('instansi', Auth()->user()->name_instansi)
            ->paginate(5);
        $jenisspms = JenisSpm::orderBy('nama', 'asc')->get();
        $pajaks = Pajak::orderBy('nama', 'asc')->get();
        $potongans = Potongan::orderBy('nama', 'asc')->get();
        $penyedias = Penyedia::orderBy('nama', 'asc')->get();

        return view('livewire.bendahara.index-s-p-m', [
            'spms' => $spms,
            'jenisspms' => $jenisspms,
            'pajaks' => $pajaks,
            'potongans' => $potongans,
            'penyedias' => $penyedias,
        ]);
    }
}
