<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;
use App\Models\Instansi;
use App\otorisasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class DaftarPengguna extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    #[Locked]
    public $userId;

    public $isOpen = false;
    public $updateMode = false;

    public $name_instansi, $name, $username, $email, $otorisasi, $keterangan, $query;

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }
    public function store()
    {
        $validatedData = $this->validate(
            [
                'name_instansi' => 'required|string',
                'name' => 'required|string',
                'username' => 'nullable|string|unique:users,username',
                'keterangan' => 'required|string',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'otorisasi' => ['required', Rule::in(['bendahara', 'ppk', 'verifikator', 'admin'])],
            ]
        );

        if (empty($validatedData['username'])) {
            $validatedData['username'] = null;
        }

        try {
            $validatedData['password'] = Hash::make('12345678');

            User::create($validatedData);
            $this->reset();
            $this->isOpen = false;
            $this->alert('success', 'Tambah Pengguna Baru Berhasil.');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Gagal tambah pengguna: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function updateId($id)
    {
        $this->resetValidation();
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->name_instansi = $user->name_instansi;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->otorisasi = $user->otorisasi;
        $this->keterangan = $user->keterangan;

        $this->updateMode = true;
        $this->isOpen = true;
    }

    public function update()
    {
        $validatedData = $this->validate(
            [
                'name_instansi' => 'required|string',
                'name' => 'required|string',
                'username' => ['nullable', 'string', Rule::unique('users', 'username')->ignore($this->userId)],
                'keterangan' => 'required|string',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
                'otorisasi' => ['required', Rule::in(['bendahara', 'ppk', 'verifikator', 'admin'])],
            ]
        );

        if (empty($validatedData['username'])) {
            $validatedData['username'] = null;
        }

        try {
            $user = User::where('id', $this->userId)
                ->where('id', '!=', auth()->user()->id)
                ->firstOrFail();

            $user->update($validatedData);

            $this->reset();
            $this->isOpen = false;
            $this->alert('success', 'Perubahan Pengguna Berhasil Disimpan');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('Gagal update pengguna: ' . $th->getMessage());
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function deleteId($id)
    {
        $this->userId = $id;
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
            User::where('id', $this->userId)
                ->where('id', '!=', auth()->user()->id)
                ->delete();
            $this->reset();
            $this->alert('success', 'Hapus Pengguna Berhasil');
        } catch (\Exception $e) {
            $this->alert('error', 'Server sedang sibuk.');
            return;
        }
    }

    public function render()
    {
        $users = User::select()
            ->where('id', '!=', auth()->user()->id)
            ->whereAny([
                'name',
                'username',
                'name_instansi',
                'email',
                'otorisasi',
                // 'keterangan',
            ], 'like', '%' . $this->query . '%')
            ->latest()
            ->paginate(5);
        $instansis = Instansi::orderBy('nama', 'asc')->get();
        return view('livewire.admin.daftar-pengguna', [
            'users' => $users,
            'instansis' => $instansis,
        ]);
    }
}
