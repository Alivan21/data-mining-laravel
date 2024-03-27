<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
  use HasFactory;

  protected $table = 'penjualan';
  protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];

  public function hitungTransaksi($idTransaksi)
  {
    return $this->where('no_faktur', $idTransaksi)->count();
  }

  public function hitungTotalQt($idTransaksi)
  {
    return $this->where('no_faktur', $idTransaksi)->sum('qty');
  }

  public function getCreatedAt($idTransaksi)
  {
    return $this->where('no_faktur', $idTransaksi)->first()->created_at;
  }

  public function getTotalHarga($idTransaksi)
  {
    $totalHarga = 0;
    $penjualan = $this->where('no_faktur', $idTransaksi)->get();
    foreach ($penjualan as $item) {
      $totalHarga += $item->qty * $item->barang->harga;
    }
    return $totalHarga;
  }

  public function barang()
  {
    return $this->belongsTo(Barang::class);
  }
}
