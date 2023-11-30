@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="{{ $barang->gambar }}" class="card-img-top" alt="{{ $barang->nama }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama }}</h5>
                        <p class="card-text">Harga: {{ $barang->harga }}</p>
                        <!-- Tambahkan informasi barang lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
