<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $totalKeranjang = array_sum(array_column(session('keranjang', []), 'jumlah'));
        return view('products.index', compact('products', 'totalKeranjang'));
    }
}