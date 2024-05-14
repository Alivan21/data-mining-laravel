<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $kategori = [
      "ELEKTRONIK",
      "PAKAIAN",
      "BAJU",
      "CELANA",
      "AKSESORIS",
      "MAKANAN RINGAN",
      "BUMBU",
      "DAGING",
      "DETERJEN",
      "PEWANGI",
      "SABUN",
      "OBAT",
      "MINUMAN"
    ];

    foreach ($kategori as $item) {
      Kategori::create([
        'nama' => $item,
      ]);
    }
  }
}
