@extends('layouts.app')

@section('title', 'Form Barang')

@section('contents')
    <form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.tambah.simpan') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method(isset($barang) ? 'PUT' : 'POST')

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Form Edit Barang
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="gambar_barang">Gambar Barang</label>
                            <input type="file" accept="image/*" name="image" class="from-control" id="image"
                                value=" {{ isset($barang) ? $barang->gambar_barang : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                value="{{ isset($barang) ? $barang->nama_barang : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Barang</label>
                            <select name="id_kategori" id="id_kategori" class="custom-select">
                                <option value="" selected disabled hidden>-- Pilih Kategori --</option>
                                @if (isset($kategori))
                                    @foreach ($kategori as $row)
                                        <option value="{{ $row->id }}"
                                            {{ isset($barang) && $barang->id_kategori == $row->id ? 'selected' : '' }}>
                                            {{ $row->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="{{ isset($barang) ? $barang->harga : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="{{ isset($barang) ? $barang->jumlah : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
