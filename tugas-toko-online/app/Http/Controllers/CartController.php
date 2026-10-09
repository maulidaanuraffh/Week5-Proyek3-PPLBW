<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $ids = array_keys($keranjang);
        $products = Product::whereIn('id_barang', $ids)->get()->keyBy('id_barang');
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $products[$item['id_barang']]->harga * $item['jumlah'];
        }

        return view('cart.index', compact('keranjang', 'products', 'total'));
    }

    public function tambah(Request $request)
    {
        $id = $request->id_barang;
        $product = Product::findOrFail($id);

        if ($product->stok == 0) {
            return back()->with('error', 'Stok barang habis.');
        }

        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            // Cek jumlah tidak melebihi stok
            if ($keranjang[$id]['jumlah'] >= $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok tersedia.');
            }
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = ['id_barang' => $id, 'jumlah' => 1];
        }

        session(['keranjang' => $keranjang]);
        return redirect()->route('cart.index')->with('success', $product->nama_barang . ' ditambahkan ke keranjang.');
    }

    public function tambahJumlah(Request $request)
    {
        $id = $request->id_barang;
        $product = Product::findOrFail($id);
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            if ($keranjang[$id]['jumlah'] >= $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok tersedia.');
            }
            $keranjang[$id]['jumlah']++;
            session(['keranjang' => $keranjang]);
        }

        return redirect()->route('cart.index');
    }

    public function kurangJumlah(Request $request)
    {
        $id = $request->id_barang;
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']--;
            if ($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            }
            session(['keranjang' => $keranjang]);
        }

        return redirect()->route('cart.index');
    }

    public function hapus(Request $request)
    {
        $id = $request->id_barang;
        $keranjang = session('keranjang', []);
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);
        return redirect()->route('cart.index');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('cart.index');
    }
}