@extends('auth.layouts.app', ['title' => 'Auth | Register'])

@section('content')
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-6">
                    <div class="mb-4">

                        <h1 class="mb-1 fw-bold">{{ __('Register') }}</h1>
                        <span>Sudah memiliki akun?
                            <a href="{{ route('login') }}" class="ms-1">{{ __('Login') }}</a></span>
                    </div>
                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3 d-lg-flex gap-1 justify-content-between">
                            <div class="col-lg-6">

                                <label for="first-name" class="col-form-label">{{ __('Nama Depan') }}</label>

                                <input id="first-name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">

                                <label for="last-name" class="col-form-label">{{ __('Nama Belakang') }}</label>

                                <input id="last-name" type="text"
                                    class="form-control @error('last-name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="**************">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <!-- Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="agreeCheck">
                                <label class="form-check-label" for="agreeCheck"><span>Saya setuju dengan <a
                                            href="terms-condition-page.html">Ketentuan dari
                                            Melayani </a>and
                                        <a href="terms-condition-page.html">Kebijakan pribadi.</a></span></label>
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrasi') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
