@extends('auth.layout.index')

@section('css')
    <style>
        body, .card {
            background-color: #390203;
        }
    </style>
@endsection

@section('user_content')
    {{-- Navbar --}}
    <header class="navbar navbar-expand-lg sticky-top nav-mob bg-transparent">
        <nav class="container flex-wrap flex-lg-nowrap">
            <a class="navbar-brand fw-semibold fs-3 title-mob" style="color: #FBC907;">PENPOS RALLY MOB FT 2024</a>
        </nav>
    </header>
    {{-- End Navbar --}}
    <div class="container cotainer-size">
        <div class="card p-4">
            <div class="row g-0 justify-content-center">
                <div class="col-md-4 logo">
                    <img src="{{ asset('image/logo.png') }}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="form-floating">
                            @csrf
                            <h2 class="text-mob" style="color: #F6F7D7;">Masuk</h2>
                            <div class="form-floating mb-3">
                                <input id="username" type="username"
                                       class="form-control @error('username') is-invalid @enderror form-control-epass"
                                       name="username" value="{{ old('username') }}" required autocomplete="off" autofocus
                                       placeholder="username">
                                <label for="username">{{ __('Username') }}</label>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror form-control-epass"
                                       name="password" required autocomplete="off" placeholder="kata sandi">
                                <label for="password">{{ __('Kata Sandi') }}</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{--                            <div class="text-end">--}}
                            {{--                                <label>--}}
                            {{--                                    <a class="nav-link active" aria-current="page" href="https://forms.gle/2XpRv5rLVAd9cvte6" target="_blank"--}}
                            {{--                                    style="color: #242a68"><b>Lupa password?</b></a>--}}
                            {{--                                </label>--}}
                            {{--                            </div>--}}

                            <div class="form-group row mb-3 mt-3">
                                <div class="col-md-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary btn-beli" style="background-color: #FBC907; border: none; color: #390203; font-weight: bolder;">
                                            {{ __('Masuk') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
