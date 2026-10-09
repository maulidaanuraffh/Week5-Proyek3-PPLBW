@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')
<div style="max-width: 480px; margin: 0 auto;">
    <div class="card">
        <h2 style="margin-bottom: 1.25rem; color: #315B8C;">Daftar Akun</h2>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Password</label>
                <input type="password" name="password" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 0.9rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">No. HP <span style="font-weight:normal; color:#888;">(opsional)</span></label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Alamat <span style="font-weight:normal; color:#888;">(opsional)</span></label>
                <textarea name="alamat" rows="2"
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">{{ old('alamat') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Daftar</button>
        </form>

        <p style="margin-top: 1rem; text-align:center; font-size:0.9rem;">
            Sudah punya akun? <a href="{{ route('login') }}" style="color:#F2765E;">Login di sini</a>
        </p>
    </div>
</div>
@endsection