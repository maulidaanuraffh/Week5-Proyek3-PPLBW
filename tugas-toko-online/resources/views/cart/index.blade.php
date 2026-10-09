@extends('layouts.app')
@section('title', 'Keranjang Belanja')

@section('content')
<h2 style="margin-bottom: 1.25rem;">Keranjang Belanja</h2>

@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

@if (empty($keranjang))
    <div class="card" style="text-align:center; color:#888;">
        <p>Keranjang masih kosong.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary" style="margin-top:0.75rem;">Mulai Belanja</a>
    </div>
@else
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keranjang as $item)
                @php $p = $products[$item['id_barang']]; @endphp
                <tr>
                    <td><strong>{{ $p->nama_barang }}</strong></td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.kurangJumlah') }}" style="display:inline">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{ $item['id_barang'] }}">
                            <button type="submit" class="btn btn-outline" style="padding:0.2rem 0.6rem;">-</button>
                        </form>

                        <strong style="margin: 0 0.5rem;">{{ $item['jumlah'] }}</strong>

                        <form method="POST" action="{{ route('cart.tambahJumlah') }}" style="display:inline">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{ $item['id_barang'] }}">
                            <button type="submit" class="btn btn-outline" style="padding:0.2rem 0.6rem;">+</button>
                        </form>
                    </td>
                    <td><strong>Rp {{ number_format($p->harga * $item['jumlah'], 0, ',', '.') }}</strong></td>
                    <td>
                        <form method="POST" action="{{ route('cart.hapus') }}">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{ $item['id_barang'] }}">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                <td colspan="2"><strong style="color:#F2765E; font-size:1.1rem;">Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="display:flex; justify-content:space-between; margin-top:1rem; flex-wrap:wrap; gap:0.5rem;">
        <form method="POST" action="{{ route('cart.kosongkan') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Kosongkan Keranjang</button>
        </form>

        <button onclick="document.getElementById('checkout-form').style.display='block'" class="btn btn-secondary">
            Checkout →
        </button>
    </div>

    {{-- Form Checkout --}}
    <div id="checkout-form" style="display:none; margin-top:1.5rem;">
        <div class="card">
            <h3 style="margin-bottom:1rem; color:#315B8C;">Konfirmasi Checkout</h3>
            <form method="POST" action="{{ route('orders.checkout') }}">
                @csrf
                <label style="display:block; font-weight:bold; margin-bottom:0.3rem;">Alamat Pengiriman</label>
                <textarea name="alamat_pengiriman" rows="3" required
                    placeholder="Masukkan alamat lengkap pengiriman..."
                    style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px; margin-bottom:1rem;">{{ Auth::user()->alamat }}</textarea>
                <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
            </form>
        </div>
    </div>
@endif
@endsection