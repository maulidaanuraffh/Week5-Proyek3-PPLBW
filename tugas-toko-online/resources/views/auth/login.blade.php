@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div style="max-width: 420px; margin: 0 auto;">
    <div class="card">
        <h2 style="margin-bottom: 1.25rem; color: #315B8C;">Login</h2>

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Password</label>
                <input type="password" name="password" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Masuk</button>
        </form>

        <p style="margin-top: 1rem; text-align:center; font-size:0.9rem;">
            Belum punya akun? <a href="{{ route('register') }}" style="color:#F2765E;">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection