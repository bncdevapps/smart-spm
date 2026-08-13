<div>
    <x-slot:title>
        Ubah Password
    </x-slot>

    @if (session()->has('warning'))
        <div class="alert alert-warning border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px; background-color: #fef3c7; border-left: 5px solid #f59e0b !important;">
            <div class="d-flex align-items-center">
                <div class="me-3 text-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div>
                    <h4 class="alert-title text-warning-emphasis fw-bold mb-1">Perhatian!</h4>
                    <div class="text-secondary" style="font-size: 0.9rem;">
                        {{ session('warning') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="alert alert-info border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px; background-color: #f0f9ff;">
        <div class="d-flex align-items-start">
            <div class="me-3 mt-1 text-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </div>
            <div>
                <h4 class="alert-title text-info-emphasis fw-bold mb-1">Kriteria Password Baru:</h4>
                <div class="text-secondary" style="font-size: 0.875rem;">
                    • Minimal <strong>8 karakter</strong><br>
                    • Mengandung setidaknya <strong>1 Huruf Besar (A-Z)</strong><br>
                    • Mengandung setidaknya <strong>1 Huruf Kecil (a-z)</strong><br>
                    • Mengandung setidaknya <strong>1 Angka (0-9)</strong><br>
                    • Mengandung setidaknya <strong>1 Karakter Khusus / Simbol (@, #, $, %, !, dll.)</strong>
                </div>
            </div>
        </div>
    </div>

    @livewire('profile.update-password-form')
</div>