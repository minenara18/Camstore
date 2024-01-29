<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('transaksi.index', [
            'transaksi' => $transaksi,
            'title' => 'Transaksi'
        ]);
    }

    public function create()
    {
        $barang = Barang::all();

        return view('transaksi.create', [
            'barang' => $barang,
            'title' => 'Tambah Transaksi'
        ]);
    }

    public function store(Request $request)
    {
        $barang = Barang::findOrFail($request->product);

        if ($request->quantity > $barang->stock) {
            return back()->with('error', 'Quantity exceeds stock, current stock is: ' . $barang->stock);
        }

        // Update stock
        $barang->stock -= $request->quantity;
        $barang->save();

        // Create new transaction
        $transaksi = Transaksi::create([
            'product_id' => $request->product,
            'quantity' => $request->quantity,
            // Sesuaikan dengan field lain yang diperlukan untuk transaksi
        ]);

        return redirect()->route('transaksi.index');
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('transaksi.show', ['transaksi' => $transaksi]);
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barang = Barang::all();

        return view('transaksi.edit', [
            'transaksi' => $transaksi,
            'barang' => $barang,
            'title' => 'Edit Transaksi'
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $barang = Barang::findOrFail($request->product);

        // Kembalikan stock yang sudah dikurangkan sebelumnya
        $barang->stock += $transaksi->quantity;
        $barang->save();

        // Update stock baru
        if ($request->quantity > $barang->stock) {
            return back()->with('error', 'Quantity exceeds stock, current stock is: ' . $barang->stock);
        }

        $barang->stock -= $request->quantity;
        $barang->save();

        // Update transaksi
        $transaksi->update([
            'product_id' => $request->product,
            'quantity' => $request->quantity,
            // Sesuaikan dengan field lain yang diperlukan untuk transaksi
        ]);

        return redirect()->route('transaksi.index');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Kembalikan stock yang sudah dikurangkan
        $barang = Barang::findOrFail($transaksi->product_id);
        $barang->stock += $transaksi->quantity;
        $barang->save();

        // Hapus transaksi
        $transaksi->delete();

        return redirect()->route('transaksi.index');
    }

}
