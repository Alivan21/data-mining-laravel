<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $totalBarang = Barang::count();
    $totalPenjualan = Penjualan::count();
    $totalHarga = Barang::sum('harga');
    $totalUser = User::count();
    $transaksiTerakhir = Penjualan::distinct()->take(10)->get(['no_faktur', 'created_at']);
    if ($totalPenjualan == 0) {
      $average = 0;
    } else {
      // Calculate average price (total price / total items sold)
      $average = $totalHarga / $totalBarang;
    }

    return view('dashboard', compact('totalBarang', 'totalPenjualan', 'totalHarga', 'transaksiTerakhir', 'average', 'totalUser'));
  }
}
