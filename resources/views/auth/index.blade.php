@extends('layout.auth')
@section('Content')
    <div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo pl-2">
                <img src="{{ asset('assets/img/logo/kuningan.png')}}" style="width: 50px;" alt="">
            </span>
            <span class="fw-bolder">Lapor Kuningan Melesat</span>
        </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Selamat datang</h4>
        <p class="mb-4">Silahkan masuk menggunakan username dan password anda</p>

        <form id="loginform" method="POST" id="form-cta-subscribe-2" class="form-inline" style="min-height: 300px;"  action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Enter your username"
            autofocus
            />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
            <a href="auth-forgot-password-basic.html">
                {{-- <small>Forgot Password?</small> --}}
            </a>
            </div>
            <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
        </div>
        </form>

    </div>
    </div>
@endsection