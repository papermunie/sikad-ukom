<!-- resources/views/pengeluaran/index.blade.php -->
@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Facades\URL; @endphp
@extends('layouts.app')
@section('title', 'Mengelola Pengeluaran Kas')
@section('content')
@section('content')
    <div class="container">
        <h1>Daftar Kas Keluar</h1>

        <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary mb-3">Tambah Kas Keluar</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($PengeluaranKass as $index => $PengeluaranKas)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $PengeluaranKas->nama }}</td>
                        <td>{{ $PengeluaranKas->jumlah }}</td>
                        <td>
                            <a href="{{ route('pengeluaran.show', $PengeluaranKas->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('pengeluaran.edit', $PengeluaranKas->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('pengeluaran.destroy', $PengeluaranKas->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
