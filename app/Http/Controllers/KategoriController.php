<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
	public function index()
	{
		$kategori = Kategori::all();

		return view('kategori/index', [
            'kategori' => $kategori,
            'title' => 'kategori'
        ]);
	}

	public function tambah()
	{
		return view('kategori.form', [
            'title' => 'Tambah Kategori'
        ]);

        return redirect()->route('kategori.index');
	}

	public function simpan(Request $request)
	{
        $data = $request->all();
		Kategori::create([
            'nama' => $request->nama
        ]);
        Kategori::create($data);

        return redirect()->route('kategori.index');
    }

	public function edit($id)
	{
		$kategori = Kategori::find($id);

		return view('kategori.form', [
            'kategori' => $kategori,
            'title' => 'Edit barang'
        ]);
	}

	public function update($id, Request $request)
	{
        $data = $request->all();
		$kategori = Kategori::find($id);

        Kategori::create($data);
        if (!$kategori) {
        return redirect()->back()->with('error', 'Kategori tidak ditemukan');
    }

		return redirect()->route('kategori');
	}

    public function hapus($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect()->back();
    }

}
