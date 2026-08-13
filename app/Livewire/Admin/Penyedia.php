<?php

namespace App\Livewire\Admin;

use App\Models\Penyedia as PenyediaModel;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Penyedia extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $penyediaId;

    public $isOpen = false;
    public $updateMode = false;

    // Data Penyedia
    public $nama;
    public $alamat;
    public $npwp;

    // Akun Pembayaran
    public $nama_bank;
    public $nama_rekening;
    public $nomor_rekening;

    public $query;

    public function closeModal()
    {
        $this->reset(['penyediaId', 'isOpen', 'updateMode', 'nama', 'alamat', 'npwp', 'nama_bank', 'nama_rekening', 'nomor_rekening']);
        $this->resetValidation();
    }

    public function store()
    {
        $validatedData = $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'npwp' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:255',
            'nama_rekening' => 'nullable|string|max:255',
            'nomor_rekening' => 'nullable|string|max:255',
        ]);

        try {
            $validatedData['name_instansi'] = auth()->user()->name_instansi;

            PenyediaModel::create($validatedData);
            $this->closeModal();
            $this->alert('success', 'Simpan Data Penyedia/Rekanan Berhasil');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Gagal tambah penyedia: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function updateId($id)
    {
        $this->resetValidation();
        $query = PenyediaModel::where('id', $id);
        if (auth()->user()->otorisasi !== 'admin') {
            $query->where('name_instansi', auth()->user()->name_instansi);
        }
        $penyedia = $query->firstOrFail();

        $this->penyediaId = $id;
        $this->nama = $penyedia->nama;
        $this->alamat = $penyedia->alamat;
        $this->npwp = $penyedia->npwp;
        $this->nama_bank = $penyedia->nama_bank;
        $this->nama_rekening = $penyedia->nama_rekening;
        $this->nomor_rekening = $penyedia->nomor_rekening;

        $this->updateMode = true;
        $this->isOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'npwp' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:255',
            'nama_rekening' => 'nullable|string|max:255',
            'nomor_rekening' => 'nullable|string|max:255',
        ]);

        try {
            $query = PenyediaModel::where('id', $this->penyediaId);
            if (auth()->user()->otorisasi !== 'admin') {
                $query->where('name_instansi', auth()->user()->name_instansi);
            }
            $penyedia = $query->firstOrFail();
            $penyedia->update($validatedData);

            $this->closeModal();
            $this->alert('success', 'Perubahan Data Penyedia/Rekanan Berhasil Disimpan');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Gagal update penyedia: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->penyediaId = $id;
        $this->alert('question', 'Hapus Data Terpilih?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus. ',
            'onConfirmed' => 'confirmedhapus',
            'showCancelButton' => true,
            'confirmButtonColor' => '#D63939',
            'position' => 'center',
            'timer' => 5000,
        ]);
    }

    protected $listeners = [
        'confirmedhapus'
    ];

    public function confirmedhapus()
    {
        try {
            $query = PenyediaModel::where('id', $this->penyediaId);
            if (auth()->user()->otorisasi !== 'admin') {
                $query->where('name_instansi', auth()->user()->name_instansi);
            }
            $query->delete();

            $this->closeModal();
            $this->alert('success', 'Hapus Data Penyedia/Rekanan Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $queryBuilder = PenyediaModel::query();

        if (auth()->user()->otorisasi !== 'admin') {
            $queryBuilder->where('name_instansi', auth()->user()->name_instansi);
        }

        $penyedias = $queryBuilder->whereAny([
                'nama',
                'npwp',
                'nama_bank',
                'nama_rekening',
                'nomor_rekening',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.penyedia', [
            'penyedias' => $penyedias,
        ]);
    }
}
