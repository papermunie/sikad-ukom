<!-- resources/views/pengeluaran_kas/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Data Pengeluaran Kas')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Pengeluaran Kas</h1>
    <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kode_pengeluaran" class="form-label">Kode Pengeluaran:</label>
            <input type="text" class="form-control" id="kode_pengeluaran" name="kode_pengeluaran" required>
        </div>     

        <div class="mb-3">
            <label for="jenis_pengeluaran" class="form-label">Jenis Pengeluaran:</label>
            <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran:</label>
            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" required>
        </div>

        <div class="input-group input-group-sm mb-3">
        <label for="jumlah_pengeluaran" class="form-label">Jumlah pemasukan:</label>
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
  </div>
  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="jumlah_pengeluaran" name="jumlah_pengeluaran" required>
</div>

        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi:</label>
            <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" accept="image/*" >
        </div>

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>

@endsection
