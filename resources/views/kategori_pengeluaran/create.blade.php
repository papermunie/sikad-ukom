<!-- resources/views/kategori_pengeluaran/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Kategori Pengeluaran</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori-pengeluaran.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
