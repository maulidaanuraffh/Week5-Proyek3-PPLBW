<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Tampilkan daftar barang
    public function index()
    {
        $barang = Barang::all();
        $keranjang = session('keranjang', []);
        $totalItem = array_sum(array_column($keranjang, 'jumlah'));
        return view('index', compact('barang', 'totalItem'));
    }

    // Tambah barang ke keranjang
    public function tambah(Request $request)
    {
        $id = $request->id;
        $barang = Barang::findOrFail($id);
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = ['id' => $id, 'jumlah' => 1];
        }

        session(['keranjang' => $keranjang]);
        return redirect()->route('index')->with('success', $barang->nama . ' ditambahkan ke keranjang.');
    }

    // Tampilkan keranjang
    public function keranjang()
    {
        $keranjang = session('keranjang', []);
        $ids = array_keys($keranjang);
        $barang = Barang::whereIn('id', $ids)->get()->keyBy('id');
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $barang[$item['id']]->harga * $item['jumlah'];
        }

        return view('keranjang', compact('keranjang', 'barang', 'total'));
    }

    // Tambah jumlah item
    public function tambahJumlah(Request $request)
    {
        $id = $request->id;
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
            session(['keranjang' => $keranjang]);
        }

        return redirect()->route('keranjang');
    }

    // Kurang jumlah item
    public function kurangJumlah(Request $request)
    {
        $id = $request->id;
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']--;

            // Kalau jumlah jadi 0, hapus item
            if ($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            }

            session(['keranjang' => $keranjang]);
        }

        return redirect()->route('keranjang');
    }

    // Hapus satu item
    public function hapus(Request $request)
    {
        $id = $request->id;
        $keranjang = session('keranjang', []);
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);
        return redirect()->route('keranjang');
    }

    // Kosongkan keranjang
    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('keranjang');
    }
}