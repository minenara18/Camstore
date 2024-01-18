@extends('layouts.app')

@section('title', 'BARANG')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        </div>
        <div class="card-body">
            @if (auth()->user()->level == 'Admin')
                <a href="{{ route('barang.tambah') }}" class="btn btn-primary mb-3">Tambah Barang</a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            @if (auth()->user()->level == 'Admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @isset($data)
                            @foreach ($data as $row)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td><img src="{{ url('storage/' . $row->image) }} " alt=""></td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ $row->kategori->nama }}</td>
                                    <td>{{ $row->harga }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    @if (auth()->user()->level == 'Admin')
                                        <td>
                                            <a href="{{ route('barang.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('barang.hapus', $row->id) }}" class="btn btn-danger"
                                                onclick="confirm('apa kamu yakin ingin menghapusnya?')">Hapus</a>
                                            @csrf
                                            @method('DELETE')

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
