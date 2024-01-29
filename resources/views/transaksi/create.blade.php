@extends('layouts.app')

@section('title', 'Form Transaksi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Transaksi</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="barang">Barang</label>
                    <select name="barang_id" id="barang" class="form-control" required>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->jumlah }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" required>
                </div>
                @if (session('eror'))
                    <div class="alert alert-danger mb-3">
                        {{ session('eror') }}
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
