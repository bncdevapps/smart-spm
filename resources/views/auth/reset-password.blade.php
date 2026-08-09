<x-guest-layout>
    <x-slot:title>
        Atur Ulang Password
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
                        <h2 class="h2 text-center mb-4">Atur Ulang Password</h2>


                        <x-validation-errors class="mb-4" />


                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">



                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email', $request->email)" required autofocus autocomplete="username"
                                    readonly />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input class="form-control" id="password" class="block mt-1 w-full" type="password"
                                    name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ulangi Password Baru</label>
                                <input class="form-control" id="password_confirmation" class="block mt-1 w-full"
                                    type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>


                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-lock-code">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2" />
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                        <path d="M20 21l2 -2l-2 -2" />
                                        <path d="M17 17l-2 2l2 2" />
                                    </svg>
                                    Atur Ulang Sekarang
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