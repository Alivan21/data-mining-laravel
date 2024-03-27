<?php

namespace App\Http\Controllers;

use App\Imports\PenjualanImport;
use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $currentPage = request()->input('page') ?? 1; // Get current page
    $perPage = 10; // Items per page (assuming 10)
    $startingRow = ($currentPage - 1) * $perPage; // Calculate starting row

    $dataPenjualan = Penjualan::select('no_faktur', 'created_at')
      ->groupBy('no_faktur', 'created_at')
      ->distinct()
      ->paginate(10);
    return view('penjualan.index', compact('dataPenjualan', 'startingRow'));
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

  public function import(Request $request)
  {
    if (!$request->hasFile('file')) {
      Alert::error("File tidak ditemukan", "Terjadi kesalahan");
      return back();
    }
    $request->validate([
      'file' => 'required|mimes:xlsx,xls',
    ]);

    try {
      $file = $request->file('file');
      $namaFile = time() . '.' . $file->getClientOriginalExtension();
      //temporary file
      $path = $file->storeAs('public/excel/', $namaFile);

      $import = Excel::import(new PenjualanImport(), storage_path('app/public/excel/' . $namaFile));
      Storage::delete($path);
      if (!$import) {
        throw new \Exception("Gagal mengimport data Penjualan");
      }
      Alert::toast('Data Penjualan berhasil diimport', 'success');
      return redirect()->route('penjualan.index');
    } catch (\Throwable $th) {
      Alert::error("Gagal mengimport data Penjualan", $th->getMessage());
      return back();
    }
  }
}
