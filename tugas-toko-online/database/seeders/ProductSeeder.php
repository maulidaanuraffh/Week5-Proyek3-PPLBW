<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_barang' => 'PRD0000001', 'nama_barang' => 'Kaos Polos',       'deskripsi' => 'Kaos katun 100% nyaman dipakai sehari-hari.',       'harga' => 75000,  'stok' => 50],
            ['id_barang' => 'PRD0000002', 'nama_barang' => 'Celana Jeans',     'deskripsi' => 'Celana jeans slim fit bahan denim premium.',          'harga' => 150000, 'stok' => 30],
            ['id_barang' => 'PRD0000003', 'nama_barang' => 'Tas Ransel',       'deskripsi' => 'Tas ransel canvas kapasitas besar anti air.',          'harga' => 200000, 'stok' => 20],
            ['id_barang' => 'PRD0000004', 'nama_barang' => 'Sepatu Sneakers',  'deskripsi' => 'Sepatu olahraga kasual ringan dan nyaman.',            'harga' => 250000, 'stok' => 15],
            ['id_barang' => 'PRD0000005', 'nama_barang' => 'Topi Baseball',    'deskripsi' => 'Topi dengan bordir keren, bahan katun.',               'harga' => 45000,  'stok' => 40],
            ['id_barang' => 'PRD0000006', 'nama_barang' => 'Dompet Kulit',     'deskripsi' => 'Dompet pria kulit sintetis model slim.',               'harga' => 85000,  'stok' => 25],
            ['id_barang' => 'PRD0000007', 'nama_barang' => 'Jam Tangan',       'deskripsi' => 'Jam tangan kasual analog tahan air.',                  'harga' => 180000, 'stok' => 10],
            ['id_barang' => 'PRD0000008', 'nama_barang' => 'Kacamata Hitam',   'deskripsi' => 'Kacamata hitam UV protection frame metal.',            'harga' => 120000, 'stok' => 18],
            ['id_barang' => 'PRD0000009', 'nama_barang' => 'Ikat Pinggang',    'deskripsi' => 'Ikat pinggang kulit dengan gesper klasik.',            'harga' => 65000,  'stok' => 35],
            ['id_barang' => 'PRD0000010', 'nama_barang' => 'Kaos Kaki',        'deskripsi' => 'Kaos kaki premium isi 3 pasang anti bau.',             'harga' => 30000,  'stok' => 60],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}