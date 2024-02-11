<!-- resources/views/kategori_pengeluaran/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kategori Pengeluaran</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori-pengeluaran.update', $kategoriPengeluaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" value="{{ $kategoriPengeluaran->jenis_pengeluaran }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
