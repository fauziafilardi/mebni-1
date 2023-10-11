@extends('layouts.frontend.login.app')

@section('content')
<section class="vh-100" style="background-color: #5aac4e;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('assets/frontend/img/hero/login.jpg') }}"
                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form class="form" id="" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1" style="justify-content: center;">
                                        <img src="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}" class="max-h-75px" alt="logo" />
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">
                                        Masyarakat Energi Baru Nuklir Indonesia
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror form-control-lg" required value="{{ old('email') }}"/>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror form-control-lg" required/>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="small text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
