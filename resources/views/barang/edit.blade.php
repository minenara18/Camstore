@extends('layouts.app')

@section('title', isset($barang) ? 'Edit Barang' : 'Form Tambah Barang')

@section('contents')
    <form action="{{ isset($barang) ? route('barang.tambah.update', $barang->id) : route('barang.tambah.simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image">image</label>
            <input type="file" accept="image/*" name="image" class="from-control" id="image">
            <span class="text-secondary">jika tidak ingin mengganti gambar tidak perlu update ulang!</span>
        </div>
        <div class="mb-3">
            <Label for="name">Nama Barang</Label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $barang->nama }}" required>
        </div>
        <div class="mb-3">
            <Label for="id_kategori">Kategori</Label>
            <input type="text" name="id_kategori" class="custum-select" id="id_kategori" value="{{ $barang->nama }}" required>
        </div>
        <div class="mb-3">
            <Label for="price">Harga</Label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $barang->harga }}" required>
        </div>
        <div class="mb-3">
            <Label for="stock">Jumlah</Label>
            <input type="number" name="stock" class="form-control" id="stock" value="{{ $barang->jumlah }}" required>
        </div>
        <div class="d-flex align-item-center gap-2">
            <button class="btn btn-primary px-3" type="submit">save changes</button>
            <a href="{{ route('barang.index')}}" class="btn btn-secondary px-3">Back</a>
        </div>
    </form>
</div>
@endsection
