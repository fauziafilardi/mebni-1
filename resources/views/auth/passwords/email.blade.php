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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1" style="justify-content: center;">
                                        <img src="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}" class="max-h-75px" alt="logo" />
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">
                                        Masyarakat Energi Baru Nuklir Indonesia
                                    </h5>

                                    <h5 class="text-center">
                                        Reset Password
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror form-control-lg" required value="{{ old('email') }}" autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Send Password Reset Link</button>
                                    </div>
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
