<?php

namespace App\Livewire\Admin;

use App\Models\Pajak as PajakModel;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Pajak extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $pajakId;

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
          
            PajakModel::create($validatedData);
            $this->reset();
            $this->alert('success', 'Simpan Pajak Berhasil');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }
    public function updateId($id)
    {
        $this->resetValidation();
        $pajak = PajakModel::findOrFail($id);
        $this->pajakId = $id;
        $this->nama = $pajak->nama;
        $this->keterangan = $pajak->keterangan;

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
            $pajak = PajakModel::where('id', $this->pajakId)              
                ->firstOrFail();
            $pajak->update($validatedData);

        
            $this->reset();
            $this->alert('success', 'Perubahan Pajak Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->pajakId = $id;
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
            PajakModel::where('id', $this->pajakId)
                ->delete();
            $this->reset();
            $this->alert('success', 'Hapus Pajak Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $pajaks = PajakModel::select()
            ->whereAny([
                'nama',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.pajak', [
            'pajaks' => $pajaks,
        ]);
    }
}
