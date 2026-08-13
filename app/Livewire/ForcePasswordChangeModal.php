<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ForcePasswordChangeModal extends Component
{
    public $showModal = false;
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        $this->checkRequirement();
    }

    public function checkRequirement()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->must_change_password || Hash::check('12345678', $user->password)) {
                $this->showModal = true;
            } else {
                $this->showModal = false;
            }
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        try {
            $user = Auth::user();
            $user->forceFill([
                'password' => Hash::make($this->password),
                'must_change_password' => false,
            ])->save();

            $this->reset(['password', 'password_confirmation']);
            $this->showModal = false;

            session()->flash('success', 'Password Anda berhasil diperbarui.');
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Password berhasil diperbarui!']);
            
            return redirect(request()->header('Referer') ?? '/dashboard');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal memperbarui password: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.force-password-change-modal');
    }
}
