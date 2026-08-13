<div>
    @if ($showModal)
        <style>
            body {
                overflow: hidden !important;
            }
            .force-modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100vw;
                height: 100vh;
                background-color: rgba(15, 23, 42, 0.88) !important;
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                z-index: 999999 !important;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1.25rem;
            }
            .force-modal-card {
                background: #ffffff !important;
                border-radius: 16px !important;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35) !important;
                width: 100%;
                max-width: 520px;
                overflow: hidden;
                border: 1px solid #e2e8f0;
                animation: forceModalPop 0.3s ease-out;
            }
            @keyframes forceModalPop {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }
            .force-modal-header {
                background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
                color: #ffffff;
                padding: 1.5rem 1.75rem;
            }
            .force-modal-body {
                padding: 1.75rem;
                background-color: #ffffff;
            }
            .force-modal-body .form-control {
                background-color: #ffffff !important;
                color: #0f172a !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 8px !important;
                padding: 0.65rem 0.85rem !important;
                font-size: 0.925rem !important;
            }
            .force-modal-body .form-control:focus {
                border-color: #2563eb !important;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
            }
            .force-modal-body label {
                color: #1e293b;
                font-weight: 600;
                font-size: 0.875rem;
                margin-bottom: 0.4rem;
            }
        </style>

        <div class="force-modal-overlay">
            <div class="force-modal-card">
                <div class="force-modal-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                        <div>
                            <h3 class="m-0 fw-bold fs-3 text-white">Wajib Ubah Password</h3>
                            <p class="m-0 text-white-50 small">Demi keamanan akun, silakan perbarui password Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="force-modal-body">
                    <div class="alert alert-warning border-0 p-3 mb-4" style="border-radius: 10px; background-color: #fffbeb; border-left: 4px solid #f59e0b !important;">
                        <div class="d-flex gap-2">
                            <svg class="text-warning flex-shrink-0 mt-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <div class="text-dark small">
                                Anda belum mengubah password bawaan (<strong>12345678</strong>). Anda <strong>tidak dapat melanjutkan</strong> atau berpindah halaman sebelum mengganti password.
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="updatePassword">
                        <!-- Password Baru -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                            <input wire:model="password" type="password" placeholder="Masukkan password baru..."
                                class="form-control @error('password') is-invalid @enderror">
                            <x-input-error2 for="password" />
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input wire:model="password_confirmation" type="password" placeholder="Ulangi password baru..."
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            <x-input-error2 for="password_confirmation" />
                        </div>

                        <!-- Kriteria Password -->
                        <div class="alert alert-info border-0 p-3 mb-4" style="border-radius: 10px; background-color: #f0f9ff; font-size: 0.825rem;">
                            <div class="fw-bold text-primary mb-1">Kriteria Kombinasi Password Wajib:</div>
                            <div class="text-secondary">
                                • Minimal <strong>8 Karakter</strong><br>
                                • Mengandung <strong>Huruf Besar (A-Z)</strong> & <strong>Huruf Kecil (a-z)</strong><br>
                                • Mengandung <strong>Angka (0-9)</strong> & <strong>Simbol Khusus (@, #, $, %, !, dll.)</strong>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="border-radius: 10px; font-size: 1rem;">
                            <span wire:loading wire:target="updatePassword" class="spinner-border spinner-border-sm me-1"></span>
                            <svg wire:loading.remove wire:target="updatePassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            Simpan Password Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
