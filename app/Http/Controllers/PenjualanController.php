<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PenjualanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // select distinct no_faktur from penjualan order by created_at desc paginate(10)
    $dataPenjualan = Penjualan::select('no_faktur', 'created_at')
      ->distinct()
      ->orderBy('created_at', 'desc')
      ->paginate(10);
    return view('penjualan.index', compact('dataPenjualan'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $semuaBarang = Barang::all();
    $noFaktur = Str::uuid();
    return view('penjualan.create', compact('semuaBarang', 'noFaktur'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'no_faktur' => 'required',
      'barang_id.*' => 'required|exists:barang,id',
      'qty.*' => 'required|numeric|min:50',
    ]);

    foreach ($request->barang_id as $key => $value) {
      Penjualan::create([
        'no_faktur' => $request->no_faktur,
        'barang_id' => $value,
        'qty' => $request->qty[$key],
      ]);
    }
    Alert::toast('Penjualan berhasil ditambahkan', 'success');
    return redirect()->route('penjualan.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Penjualan  $penjualan
   * @return \Illuminate\Http\Response
   */
  public function show(Penjualan $penjualan)
  {
    $penjualan = Penjualan::where('no_faktur', $penjualan->no_faktur)->get();
    $semuaBarang = Barang::all();
    return view('penjualan.show', compact('penjualan', 'semuaBarang'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Penjualan  $penjualan
   * @return \Illuminate\Http\Response
   */
  public function edit(Penjualan $penjualan)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Penjualan  $penjualan
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Penjualan $penjualan)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Penjualan  $penjualan
   * @return \Illuminate\Http\Response
   */
  public function destroy(Penjualan $penjualan)
  {
    //
  }
}
