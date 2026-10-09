@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('orders.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div class="card" style="margin-bottom: 1rem;">
    <h2 style="color:#315B8C; margin-bottom:0.75rem;">Detail Pesanan</h2>
    <p><strong>ID Pesanan:</strong> <code>{{ $order->id_order }}</code></p>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y, H:i') }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $detail)
        <tr>
            <td><strong>{{ $detail->product->nama_barang }}</strong></td>
            <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
            <td>{{ $detail->jumlah_beli }}</td>
            <td><strong>Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}</strong></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
            <td><strong style="color:#F2765E; font-size:1.1rem;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
    </tfoot>
</table>
@endsection