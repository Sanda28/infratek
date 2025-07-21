@extends('landingpage.layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
    }

    .login-card {
        width: 100%;
        max-width: 1000px;
        display: flex;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .login-image {
        flex: 1;
        background: url('{{ asset('assets/img/menara.png') }}') no-repeat center center;
        background-size: cover;
    }

    .login-form {
        flex: 1;
        background: #fff;
        padding: 3rem;
    }
</style>

<div class="login-page">
    <div class="login-card">
        <div class="login-image d-none d-md-block"></div>
        <div class="login-form">
            <h3 class="mb-4">INFRATEK</h3>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small">Lupa kata sandi?</a>
                    @endif

                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
