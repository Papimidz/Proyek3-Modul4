<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'id_barang' => 'BRG001',
                'nama_barang' => 'Laptop',
                'deskripsi' => 'Laptop untuk belajar dan bekerja.',
                'harga' => 7500000,
                'stok' => 10,
                'gambar' => 'produk1.jpg',
            ],
            [
                'id_barang' => 'BRG002',
                'nama_barang' => 'Mouse Wireless',
                'deskripsi' => 'Mouse tanpa kabel.',
                'harga' => 150000,
                'stok' => 20,
                'gambar' => 'produk2.jpg',
            ],
            [
                'id_barang' => 'BRG003',
                'nama_barang' => 'Keyboard',
                'deskripsi' => 'Keyboard untuk komputer.',
                'harga' => 250000,
                'stok' => 15,
                'gambar' => 'produk3.jpg',
            ],
            [
                'id_barang' => 'BRG004',
                'nama_barang' => 'Headset',
                'deskripsi' => 'Headset untuk mendengarkan audio.',
                'harga' => 180000,
                'stok' => 12,
                'gambar' => 'produk4.jpg',
            ],
            [
                'id_barang' => 'BRG005',
                'nama_barang' => 'Monitor',
                'deskripsi' => 'Monitor untuk komputer desktop.',
                'harga' => 1600000,
                'stok' => 8,
                'gambar' => 'produk5.jpg',
            ],
            [
                'id_barang' => 'BRG006',
                'nama_barang' => 'Webcam',
                'deskripsi' => 'Kamera untuk video conference.',
                'harga' => 350000,
                'stok' => 10,
                'gambar' => 'produk6.jpg',
            ],
            [
                'id_barang' => 'BRG007',
                'nama_barang' => 'Flashdisk 64GB',
                'deskripsi' => 'Media penyimpanan data portabel.',
                'harga' => 90000,
                'stok' => 25,
                'gambar' => 'produk7.jpg',
            ],
            [
                'id_barang' => 'BRG008',
                'nama_barang' => 'Speaker',
                'deskripsi' => 'Speaker untuk komputer.',
                'harga' => 220000,
                'stok' => 14,
                'gambar' => 'produk8.jpg',
            ],
            [
                'id_barang' => 'BRG009',
                'nama_barang' => 'Printer',
                'deskripsi' => 'Printer untuk mencetak dokumen.',
                'harga' => 1200000,
                'stok' => 7,
                'gambar' => 'produk9.jpg',
            ],
            [
                'id_barang' => 'BRG010',
                'nama_barang' => 'Mouse Pad',
                'deskripsi' => 'Alas untuk mouse komputer.',
                'harga' => 50000,
                'stok' => 30,
                'gambar' => 'produk10.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['id_barang' => $product['id_barang']],
                $product
            );
        }
    }
}
