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
            'title' => 'Add New Transaksi'
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

    // Metode lain seperti show(), edit(), update(), dan destroy() tetap sama
}
