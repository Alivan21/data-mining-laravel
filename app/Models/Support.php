<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
  use HasFactory;

  protected $table = 'support';
  protected $fillable = [
    'kode_pengujian',
    'barang_id',
    'support'
  ];

  public function barang()
  {
    return $this->belongsTo(Barang::class);
  }

  public function dataBarang($barang_id)
  {
    return Barang::where('id', $barang_id)->first();
  }

  public function totalTransaksi()
  {
    return Penjualan::where('barang_id', $this->barang_id)->count();
  }
}
