@extends('layouts.app')
@section('title', 'Daftar Produk')

@section('content')

@auth
    <p style="margin-bottom: 0.5rem; color: #FF6B6B; font-size: 0.9rem;">Halo, {{ Auth::user()->nama_lengkap }}</p>
@endauth

<h2 style="margin-bottom: 1.25rem; color: #1A3A6B;">Daftar Barang</h2>

@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
    @foreach ($products as $product)
    <div style="background: #F0D5D5; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(107,58,58,0.12);">

        {{-- Image area --}}
        <div style="height: 160px; overflow: hidden;">
            @if ($product->gambar)
                <img src="{{ asset('images/products/' . $product->gambar) }}"
                    alt="{{ $product->nama_barang }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="background: #6B3A3A; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                    🛍️
                </div>
            @endif
        </div>

        {{-- Info Produk --}}
        <div style="padding: 0.85rem;">
            <p style="font-weight: bold; font-size: 0.95rem; margin-bottom: 0.3rem; color: #6B3A3A;">{{ $product->nama_barang }}</p>
            <p style="color: #C4717A; font-weight: bold; font-size: 0.9rem; margin-bottom: 0.25rem;">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </p>
            <p style="font-size: 0.8rem; margin-bottom: 0.75rem;">
                @if ($product->stok == 0)
                    <span style="color: #9e3030; font-weight: bold;">Stok habis</span>
                @else
                    <span style="color: #7a5050;">Stok: {{ $product->stok }}</span>
                @endif
            </p>

            @auth
                @if ($product->stok > 0)
                    <form method="POST" action="{{ route('cart.tambah') }}">
                        @csrf
                        <input type="hidden" name="id_barang" value="{{ $product->id_barang }}">
                        <button type="submit" class="btn btn-primary" style="width:100%; font-size:0.85rem;">
                            + Keranjang
                        </button>
                    </form>
                @else
                    <button class="btn" style="width:100%; background:#ddc5c5; color:#a08080; cursor:not-allowed; font-size:0.85rem;" disabled>
                        Tidak dapat dibeli
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline" style="width:100%; text-align:center; font-size:0.85rem;">
                    Login untuk beli
                </a>
            @endauth
        </div>

    </div>
    @endforeach
</div>

@endsection
