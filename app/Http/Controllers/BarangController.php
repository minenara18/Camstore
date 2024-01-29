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
        $kategori = Kategori::all();
        return view ('barang.index', [
            'barang' => $barang,
            'kategori'=> $kategori,
            'title' => 'Barang'
        ]);
    }

    public function tambah()
    {
        $kategori=Kategori::all();
        return view('barang.form', [
            'title' => 'Tambah Barang',
            'kategori'=> $kategori
        ]);

        return redirect()->route('barang.index');

    }

    public function simpan(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'gambar_barang' => 'required',
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data['photo'] = $request->file('photo')->store('barang', 'public');
        } else {
            $data['photo'] = null;
        }

        Barang::create($data);

        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('barang.form', [
            'barang' => $barang,
            'kategori' => $kategori,
            'title' => 'Edit Barang'
        ]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $request->validate([
            'gambar_barang'=>'required',
            'nama_barang'=>'required',
            'id_kategori'=>'required',
            'harga'=>'required',
            'jumlah'=>'required',
        ]);

        if(!empty($data['photo'])) {
            $data['photo'] = $request->file('photo')->store('barang', 'public');
        }else{
            unset($data['photo']);
        }

        Barang::find($id);
        Barang::create($data);

        return redirect()->route('barang');
    }

    public function hapus($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.detail', compact('barang'));
    }

    public function dashboard()
    {
        $barang = Barang::all();

        return view('dashboard', compact('barang'));
    }

    public function detail($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.detail', ['barang' => $barang]);
    }

}
