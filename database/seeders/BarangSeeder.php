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
        'qty' => 100,
      ],
      [
        'nama' => 'Celana Pendek',
        'kategori_id' => 1,
        'harga' => 50000,
        'qty' => 50,
      ],
      [
        'nama' => 'Celana Panjang',
        'kategori_id' => 1,
        'harga' => 100000,
        'qty' => 30,
      ],
      [
        'nama' => 'Kemeja',
        'kategori_id' => 1,
        'harga' => 150000,
        'qty' => 20,
      ],
      [
        'nama' => 'Jaket',
        'kategori_id' => 1,
        'harga' => 200000,
        'qty' => 10,
      ],
      [
        'nama' => 'Smartphone',
        'kategori_id' => 2,
        'harga' => 2000000,
        'qty' => 5,
      ],
      [
        'nama' => 'Laptop',
        'kategori_id' => 2,
        'harga' => 5000000,
        'qty' => 3,
      ],
      [
        'nama' => 'Tablet',
        'kategori_id' => 2,
        'harga' => 3000000,
        'qty' => 4,
      ],
      [
        'nama' => 'Printer',
        'kategori_id' => 2,
        'harga' => 1000000,
        'qty' => 2,
      ],
      [
        'nama' => 'Scanner',
        'kategori_id' => 2,
        'harga' => 1500000,
        'qty' => 1,
      ],
      [
        'nama' => 'Roti',
        'kategori_id' => 3,
        'harga' => 5000,
        'qty' => 100,
      ],
      [
        'nama' => 'Kue',
        'kategori_id' => 3,
        'harga' => 10000,
        'qty' => 50,
      ],
      [
        'nama' => 'Mie Instan',
        'kategori_id' => 3,
        'harga' => 3000,
        'qty' => 200,
      ],
    ];

    foreach ($barang as $item) {
      Barang::create($item);
    }
  }
}
