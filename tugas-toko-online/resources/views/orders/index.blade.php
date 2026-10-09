@extends('layouts.app')
@section('title', 'Riwayat Pesanan')

@section('content')
<h2 style="margin-bottom: 1.25rem;">Riwayat Pesanan</h2>

@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if ($orders->isEmpty())
    <div class="card" style="text-align:center; color:#888;">
        <p>Belum ada pesanan.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary" style="margin-top:0.75rem;">Mulai Belanja</a>
    </div>
@else
    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Alamat Pengiriman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td><code>{{ $order->id_order }}</code></td>
                <td>{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y, H:i') }}</td>
                <td><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                <td style="font-size:0.9rem; color:#666;">{{ $order->alamat_pengiriman }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id_order) }}" class="btn btn-secondary">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection