<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

    <h2>Keranjang Belanja Tanpa Login</h2>
    <p><a href="{{ route('index') }}">← Lanjut Belanja</a></p>
    <hr>

    @if (empty($keranjang))
        <p>Keranjang masih kosong.</p>
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
                    @php $b = $barang[$item['id']]; @endphp
                    <tr>
                        <td>{{ $b->nama }}</td>
                        <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('kurangJumlah') }}" style="display:inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                <button type="submit">-</button>
                            </form>

                            {{ $item['jumlah'] }}

                            <form method="POST" action="{{ route('tambahJumlah') }}" style="display:inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                <button type="submit">+</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($b->harga * $item['jumlah'], 0, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('hapus') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <br>
        <form method="POST" action="{{ route('kosongkan') }}">
            @csrf
            <button type="submit">Kosongkan Keranjang</button>
        </form>
    @endif

</body>
</html>