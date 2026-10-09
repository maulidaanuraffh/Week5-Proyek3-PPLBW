<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Proses checkout
    public function checkout(Request $request)
    {
        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $request->validate([
            'alamat_pengiriman' => 'required|string',
        ]);

        $ids = array_keys($keranjang);
        $products = Product::whereIn('id_barang', $ids)->get()->keyBy('id_barang');

        // Hitung total dari server (bukan dari browser)
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $products[$item['id_barang']]->harga * $item['jumlah'];
        }

        // Generate id_order
        $count = Order::count() + 1;
        $id_order = 'ORD' . str_pad($count, 12, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($id_order, $keranjang, $products, $total, $request) {
            // Buat order
            Order::create([
                'id_order'          => $id_order,
                'id_user'           => Auth::user()->id_user,
                'tanggal_order'     => now(),
                'total_harga'       => $total,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            // Buat order details + kurangi stok
            foreach ($keranjang as $item) {
                $product = $products[$item['id_barang']];

                OrderDetail::create([
                    'id_order'     => $id_order,
                    'id_barang'    => $item['id_barang'],
                    'harga_satuan' => $product->harga,
                    'jumlah_beli'  => $item['jumlah'],
                ]);

                // Kurangi stok
                $product->decrement('stok', $item['jumlah']);
            }

            // Kosongkan keranjang
            session()->forget('keranjang');
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Riwayat pesanan
    public function index()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Detail pesanan
    public function show($id_order)
    {
        $order = Order::where('id_order', $id_order)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $details = OrderDetail::with('product')
            ->where('id_order', $id_order)
            ->get();

        return view('orders.show', compact('order', 'details'));
    }
}