<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $semuaBarang = Barang::query()->paginate(10);
    $semuaKategori = Kategori::all();
    return view('barang.index', compact('semuaBarang', 'semuaKategori'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $semuaKategori = Kategori::all();
    return view('barang.create', compact('semuaKategori'));
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
      'nama' => 'required',
      'kategori_id' => 'required|exists:kategori,id',
      'harga' => 'required|numeric',
    ]);

    try {
      Barang::create($request->all());
      Alert::toast('Barang berhasil ditambahkan', 'success');
      return redirect()->route('barang.index');
    } catch (\Throwable $th) {
      Alert::error("Gagal menambahkan barang", "Terjadi kesalahan");
      return back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Barang  $barang
   * @return \Illuminate\Http\Response
   */
  public function show(Barang $barang)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Barang  $barang
   * @return \Illuminate\Http\Response
   */
  public function edit(Barang $barang)
  {
    $barang = Barang::query()->find($barang->id);
    $semuaKategori = Kategori::all();
    return view('barang.edit', compact('barang', 'semuaKategori'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Barang  $barang
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Barang $barang)
  {
    $request->validate([
      'nama' => 'required',
      'kategori_id' => 'required|exists:kategori,id',
      'harga' => 'required|numeric',
    ]);

    try {
      $barang->update($request->all());
      Alert::toast('Barang berhasil diubah', 'success');
      return redirect()->route('barang.index');
    } catch (\Throwable $th) {
      Alert::error("Gagal mengubah barang", "Terjadi kesalahan");
      return back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Barang  $barang
   * @return \Illuminate\Http\Response
   */
  public function destroy(Barang $barang)
  {
    try {
      $barang->delete();
      Alert::toast('Barang berhasil dihapus', 'success');
      return redirect()->route('barang.index');
    } catch (\Throwable $th) {
      Alert::error("Gagal menghapus barang", "Terjadi kesalahan");
      return back();
    }
  }
}