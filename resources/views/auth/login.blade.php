<x-guest-layout>
    <x-slot:title>
        Login
    </x-slot>

    <style>
        body, .page, .page-center, .container-normal {
            background-color: #0f172a !important;
            background-image: url('{{ asset('bg-login.png') }}') !important;
            background-size: cover !important;
            background-position: center center !important;
            background-repeat: no-repeat !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        .page-center {
            justify-content: center;
        }

        .container-normal {
            display: flex !important;
            justify-content: flex-end !important;
            align-items: center !important;
            padding-right: 7% !important;
        }

        .login-page-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            box-sizing: border-box;
        }

        /* Card yang pas menutupi & menyelaraskan kotak putih bg-login.png */
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 2.5rem 2.25rem;
            width: 100%;
            max-width: 480px;
            z-index: 10;
            transition: all 0.3s ease;
        }

        @media (min-width: 1400px) {
            .login-page-wrapper {
                padding-right: 8%;
            }
            .login-card {
                max-width: 510px;
                padding: 3rem 2.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .login-page-wrapper {
                justify-content: center;
                padding: 2rem 1.5rem;
            }
        }

        .form-title {
            color: #0f172a;
            font-weight: 800;
            font-size: 1.85rem;
            letter-spacing: -0.5px;
            margin-bottom: 0.25rem;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1.75rem;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-left {
            position: absolute;
            left: 14px;
            color: #64748b;
            z-index: 5;
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .input-icon-right {
            position: absolute;
            right: 14px;
            color: #64748b;
            z-index: 5;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .input-icon-right:hover {
            color: #1e293b;
        }

        .custom-input {
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 0.85rem 2.75rem 0.85rem 2.75rem !important;
            font-size: 0.95rem !important;
            color: #0f172a !important;
            transition: all 0.25s ease !important;
            width: 100%;
        }

        .custom-input:focus {
            background-color: #ffffff !important;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12) !important;
        }

        .custom-btn {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            border: none;
            border-radius: 12px;
            padding: 0.95rem;
            font-weight: 700;
            font-size: 1.05rem;
            color: white;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px -4px rgba(37, 99, 235, 0.4);
        }

        .custom-btn:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -4px rgba(37, 99, 235, 0.5);
            color: white;
        }
    </style>

    <div class="login-page-wrapper">
        <div class="login-card">
            <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                <img src="{{ asset('logo.png') }}" alt="Logo Tabalong" style="height: 52px; object-fit: contain;">
                <img src="{{ asset('tabalong-smart.webp') }}" alt="Tabalong Smart" style="height: 52px; object-fit: contain;">
            </div>

            <div class="text-center text-lg-start">
                <h1 class="form-title">Masuk</h1>
                <p class="form-subtitle">Masuk ke sistem <strong>SMART SPM</strong></p>
            </div>

            <x-validation-errors class="mb-4 alert alert-danger border-0 p-3" style="border-radius: 10px; font-size: 0.875rem;" />

            @session('status')
                <div class="alert alert-success alert-dismissible mb-4 border-0 p-3" role="alert" style="border-radius: 10px; font-size: 0.875rem;">
                    <div>{{ $value }}</div>
                    <a class="btn-close p-3" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- NIP / Username Input -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-slate-700" style="font-size: 0.875rem; margin-bottom: 0.4rem;">NIP Pegawai / Username</label>
                    <div class="input-group-custom">
                        <span class="input-icon-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                        <input class="form-control custom-input" placeholder="Masukkan NIP Pegawai Anda"
                        id="email" type="text" name="email" :value="old('email')" required autofocus autocomplete="username">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-semibold text-slate-700 m-0" style="font-size: 0.875rem;">Password</label>
                        
                    </div>
                    <div class="input-group-custom">
                        <span class="input-icon-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input class="form-control custom-input" placeholder="Masukkan password Anda"
                        id="password" type="password" name="password" required autocomplete="current-password">
                        <button type="button" class="input-icon-right" onclick="togglePasswordVisibility()" aria-label="Toggle Password Visibility">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-4">
                    <label class="form-check d-flex align-items-center m-0">
                        <input type="checkbox" checked class="form-check-input mt-0" id="remember_me" name="remember" style="width: 1.15rem; height: 1.15rem; border-color: #cbd5e1; border-radius: 5px; cursor: pointer;"/>
                        <span class="form-check-label ms-2" style="color: #475569; font-size: 0.875rem; cursor: pointer;">Ingat sesi saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn w-100 custom-btn d-flex justify-content-center align-items-center gap-2">
                        Masuk ke Aplikasi
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>`;
            }
        }
    </script>
</x-guest-layout>
