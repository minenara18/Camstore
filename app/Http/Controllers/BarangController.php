<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::get();
        return view('barang.index', ['barangs' => $barang]);
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('barang.form', ['kategori' => $kategori]);
    }

    public function simpan(Request $request)
    {
        $data = [
            'gambar_barang' => $request->gambar_barang,
            'nama_barang' => $request->nama_barang,
            'id_kategori' => $request->id_kategori,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ];

        Barang::create($data);

        return redirect()->route('barang');
    }

    public function edit($id)
    {
        $barang = Barang::find($id)->first();
        $kategori = Kategori::all();
        return view('barang.form', ['barang' => $barang, 'kategori' => $kategori]);
    }

    public function update($id, Request $request)
    {
        $barang = Barang::find($id);

        $request->validate([
            'id_kategori' => 'required',

        ]);

        $barang->gambar_barang = $request->file('gambar_barang'); // Sesuaikan dengan nama field yang benar
        $barang->nama_barang = $request->nama_barang;
        $barang->id_kategori = $request->id_kategori; // Menggunakan $request->id_kategori
        $barang->harga = $request->harga;
        $barang->jumlah = $request->jumlah;

        // if ($request->has('id_kategori') && $request->id_kategori !== null) {
        //     $barang->id_kategori = $request->id_kategori;
        // } else {
        //     return back()->with('error', 'ID Kategori harus diisi!');
        // }

        $barang->save();

        return redirect()->route('barang.index');
    }

    public function hapus($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang');
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.detail', compact('barang'));
    }

    public function dashboard()
    {
        $barangs = Barang::all();

        return view('dashboard', compact('barangs'));
    }

    public function detail($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.detail', ['barang' => $barang]);
    }

}
