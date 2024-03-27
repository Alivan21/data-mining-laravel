<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $barang = [
      [
        'nama' => 'Kaos Kaki',
        'kategori_id' => 1,
        'harga' => 10000,
      ],
      [
        'nama' => 'Celana Pendek',
        'kategori_id' => 1,
        'harga' => 50000,
      ],
      [
        'nama' => 'Celana Panjang',
        'kategori_id' => 1,
        'harga' => 100000,
      ],
      [
        'nama' => 'Kemeja',
        'kategori_id' => 1,
        'harga' => 150000,
      ],
      [
        'nama' => 'Jaket',
        'kategori_id' => 1,
        'harga' => 200000,
      ],
      [
        'nama' => 'Smartphone',
        'kategori_id' => 2,
        'harga' => 2000000,
      ],
      [
        'nama' => 'Laptop',
        'kategori_id' => 2,
        'harga' => 5000000,
      ],
      [
        'nama' => 'Tablet',
        'kategori_id' => 2,
        'harga' => 3000000,
      ],
      [
        'nama' => 'Printer',
        'kategori_id' => 2,
        'harga' => 1000000,
      ],
      [
        'nama' => 'Scanner',
        'kategori_id' => 2,
        'harga' => 1500000,
      ],
      [
        'nama' => 'Roti',
        'kategori_id' => 3,
        'harga' => 5000,
      ],
      [
        'nama' => 'Kue',
        'kategori_id' => 3,
        'harga' => 10000,
      ],
      [
        'nama' => 'Mie Instan',
        'kategori_id' => 3,
        'harga' => 3000,
      ],
    ];

    foreach ($barang as $item) {
      Barang::create($item);
    }
  }
}
