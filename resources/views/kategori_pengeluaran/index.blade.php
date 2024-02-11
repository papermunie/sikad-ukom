<!-- resources/views/kategori_pengeluaran/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Kategori Pengeluaran</h2>

        <a href="{{ route('kategori-pengeluaran.create') }}" class="btn btn-success mb-2">Tambah Kategori</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoriPengeluarans as $kategori)
                    <tr>
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->jenis_pengeluaran }}</td>
                        <td>
                            <a href="{{ route('kategori-pengeluaran.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori-pengeluaran.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
