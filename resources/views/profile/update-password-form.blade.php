<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-column align-items-start">
        <h3 class="card-title fw-bold text-dark m-0">Ubah Password Akun</h3>
        <span class="text-muted small mt-1">Pastikan akun Anda menggunakan kata sandi yang kuat dan aman</span>
    </div>

    <x-form-section submit="updatePassword">
        <x-slot name="form">
            <div class="card-body bg-light-subtle py-4">
                <div class="row g-3">
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label fw-semibold text-dark">Password Saat Ini</label>
                        <x-input id="current_password" type="password" class="form-control bg-white shadow-none" wire:model="state.current_password"
                            autocomplete="current-password" placeholder="Masukkan password lama" />
                        <x-input-error for="current_password" class="mt-1 small text-danger" />
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label fw-semibold text-dark">Password Baru</label>
                        <x-input id="password" type="password" class="form-control bg-white shadow-none" wire:model="state.password" autocomplete="new-password" placeholder="Minimal 8 karakter" />
                        <x-input-error for="password" class="mt-1 small text-danger" />
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <label class="form-label fw-semibold text-dark">Konfirmasi Password Baru</label>
                        <x-input id="password_confirmation" type="password" class="form-control bg-white shadow-none" wire:model="state.password_confirmation"
                            autocomplete="new-password" placeholder="Ulangi password baru" />
                        <x-input-error for="password_confirmation" class="mt-1 small text-danger" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <div class="card-footer bg-white border-top py-3 d-flex align-items-center justify-content-between">
                <x-action-message class="text-success fw-bold me-3" on="saved">
                    ✓ {{ __('Password Baru Berhasil Disimpan.') }}
                </x-action-message>

                <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4 ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-1.751 .154a1 1 0 0 1 -1.086 -1.086l.154 -1.751a2 2 0 0 1 .578 -1.239l6.558 -6.558l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                    </svg>
                    Simpan Password
                </button>
            </div>
        </x-slot>
    </x-form-section>
</div>