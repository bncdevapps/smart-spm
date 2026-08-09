<x-guest-layout>

    <x-slot:title>
        Lupa Password
        </x-slot>

        <div class="col-lg">
            <div class="container-tight">
                <div class="text-center mb-4">
                    <a href="{{route('login')}}"
                        class="d-flex align-items-center justify-content-center text-black m-1 p-0 text-decoration-none">
                        <img src="{{ asset('dist/img/logo.svg') }}" alt="Logo" class="navbar-brand-image me-2"
                            style="height: 36px;">
                        <strong style="font-size: 26px;">{{str_replace('_', ' ', config('app.name'))}}</strong>
                    </a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Lupa Password</h2>

                        <p class="text-secondary mb-4">
                            Masukkan alamat email Anda dan kata sandi Anda akan diatur ulang dan dikirimkan melalui
                            email kepada Anda.
                        </p>

                        <x-validation-errors class="mb-4" />

                        @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                        @endsession

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" placeholder="contoh@email.com" id="email" type="email"
                                    name="email" :value="old('email')" required autofocus autocomplete="username">
                            </div>                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                        <path d="M3 7l9 6l9 -6"></path>
                                    </svg>
                                    Kirim Password Baru Ke Email Saya!
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-lg d-none d-lg-block">
            <img src="{{ asset('static/illustrations/undraw_secure_login_pdn4.svg')}}" height="300"
                class="d-block mx-auto" alt="">
        </div>

      
</x-guest-layout>