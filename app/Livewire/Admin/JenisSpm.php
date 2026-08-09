<?php

namespace App\Livewire\Admin;

use App\Models\JenisSpm as ModelsJenisSpm;
use Livewire\Component;

use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class JenisSpm extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $jenisspmsId;

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

            ModelsJenisSpm::create($validatedData);
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
        $instansi = ModelsJenisSpm::findOrFail($id);
        $this->jenisspmsId = $id;
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
            $instansi = ModelsJenisSpm::where('id', $this->jenisspmsId)
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
        $this->jenisspmsId = $id;
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
            ModelsJenisSpm::where('id', $this->jenisspmsId)
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
        $jenisspms = ModelsJenisSpm::select()
            ->whereAny([
                'nama',
                // 'keterangan',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.admin.jenis-spm', [
            'jenisspms' => $jenisspms,
        ]);
    }
    
}
