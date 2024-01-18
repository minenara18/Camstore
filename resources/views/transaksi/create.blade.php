@extends('layouts.app')

@section('title', 'Create Transaksi')

@section('contents')
<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="barang">Barang</label>
        <select name="barang_id" id="barang" class="form-control" required>
            @foreach ($barangs as $item)
                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->jumlah }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <Label for="jumlah">Jumlah</Label>
        <input type="number" name="quantity" class="form-control" id="quantity" required>
    </div>
    @if (session('eror'))
        <div class="alert alert-danger mb-3">
            {{ session('eror') }}
        </div>
    @endif
</form>
