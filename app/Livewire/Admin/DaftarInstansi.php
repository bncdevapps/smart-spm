<?php

namespace App\Livewire\Admin;

use App\Models\Instansi;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class DaftarInstansi extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $instansiId;

    public $isOpen = false;
    public $updateMode = false;

    public $nama, $keterangan, $query;

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }
    public function store()
    {
        $validatedData = $this->validate(
            [
                'nama' => 'required|string|max:255',
                'keterangan' => 'required|string',
            ]
        );
        try {
          
            Instansi::create($validatedData);
            $this->reset();
            $this->alert('success', 'Simpan Instansi Berhasil');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }
    public function updateId($id)
    {
        $this->resetValidation();
        $instansi = Instansi::findOrFail($id);
        $this->instansiId = $id;
        $this->nama = $instansi->nama;
        $this->keterangan = $instansi->keterangan;

        $this->updateMode = true;
        $this->isOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate(
            [
                'nama' => 'required|string|max:255',
                'keterangan' => 'required|string',
            ]
        );
        try {
            $instansi = Instansi::where('id', $this->instansiId)              
                ->firstOrFail();
            $instansi->update($validatedData);

        
            $this->reset();
            $this->alert('success', 'Perubahan Instansi Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->instansiId = $id;
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
            Instansi::where('id', $this->instansiId)
                ->delete();
            $this->reset();
            $this->alert('success', 'Hapus Instansi Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $instansis = Instansi::select()
            ->whereAny([
                'nama',
                // 'keterangan',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.daftar-instansi', [
            'instansis' => $instansis,
        ]);
    }
}
