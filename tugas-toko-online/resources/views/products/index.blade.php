@extends('layouts.app')
@section('title', 'Daftar Produk')

@section('content')
@auth
    <span style="color: #597928; font-size: 0.9rem;">Halo, {{ Auth::user()->nama_lengkap }}</span>
@endauth
<h2 style="margin-bottom: 1.25rem;">Daftar Barang</h2>

@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
    @foreach ($products as $product)
    <div style="background: #91AE6E; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">

        {{-- Image area --}}
        <div style="background: #689D4B; height: 120px; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
            @if ($product->gambar)
                 <img src="{{ asset('images/products/' . $product->gambar) }}"
                    alt="{{ $product->nama_barang }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            @else
                🛒
            @endif
        </div>

        {{-- Info Produk --}}
        <div style="padding: 0.85rem;">
            <p style="font-weight: bold; font-size: 0.95rem; margin-bottom: 0.3rem;">{{ $product->nama_barang }}</p>
            <p style="color: #2e5a0e; font-weight: bold; font-size: 0.9rem;">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

            @if ($product->stok == 0)
                <p style="font-size: 0.8rem; color: #a83232; font-weight: bold; margin-bottom: 0.75rem;">
                    Stok habis
                </p>
            @else 
                <p style="font-size: 0.8rem; color: #444; margin-bottom: 0.75rem;">
                    Stok: {{ $product->stok }}
                </p>
            @endif

            @can('use-cart')
                @if ($product->stok > 0)
                    <form method="POST" action="{{ route('cart.tambah') }}">
                        @csrf
                        <input type="hidden" name="id_barang" value="{{ $product->id_barang }}">
                        <button type="submit" class="btn btn-primary" style="width:100%; font-size:0.85rem;">
                            Masukkan ke keranjang
                        </button>
                    </form>
                @else
                    <button class="btn" style="width:100%; background:#bbb; color:#777; cursor:not-allowed; font-size:0.85rem;" disabled>
                        Tidak dapat dibeli
                    </button>
                @endif
            @endcan

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline" style="width:100%; text-align:center; font-size:0.85rem;">
                    Login untuk beli
                </a>
            @endguest
        </div>
    </div>
    @endforeach
</div>
@endsection