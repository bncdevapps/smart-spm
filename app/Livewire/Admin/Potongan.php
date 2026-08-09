<?php

namespace App\Livewire\Admin;

use App\Models\Potongan as PotonganModel;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Potongan extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $potonganId;

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
          
            PotonganModel::create($validatedData);
            $this->reset();
            $this->alert('success', 'Simpan Potongan Berhasil');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }
    public function updateId($id)
    {
        $this->resetValidation();
        $potongan = PotonganModel::findOrFail($id);
        $this->potonganId = $id;
        $this->nama = $potongan->nama;
        $this->keterangan = $potongan->keterangan;

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
            $potongan = PotonganModel::where('id', $this->potonganId)              
                ->firstOrFail();
            $potongan->update($validatedData);

        
            $this->reset();
            $this->alert('success', 'Perubahan Potongan Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->potonganId = $id;
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
            PotonganModel::where('id', $this->potonganId)
                ->delete();
            $this->reset();
            $this->alert('success', 'Hapus Potongan Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $potongans = PotonganModel::select()
            ->whereAny([
                'nama',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.potongan', [
            'potongans' => $potongans,
        ]);
    }
}
