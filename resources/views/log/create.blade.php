<!-- resources/views/pemasukan_kas/create.blade.php -->
@extends('layouts.app')

@section('title', 'Log Activity')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Pemasukan Kas</h1>
    <form action="{{ route('pemasukan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jenis_pemasukan" class="form-label">Jenis Pemasukan:</label>
                    <input type="text" class="form-control" id="jenis_pemasukan" name="jenis_pemasukan" required style="background-color: #C5C5F2; color: black;">
                    <!-- Menetapkan warna biru pada input dan teks putih -->
                </div>  

                <div class="mb-3">
                    <label for="tanggal_pemasukan" class="form-label">Tanggal Pemasukan:</label>
                    <input type="date" class="form-control" id="tanggal_pemasukan" name="tanggal_pemasukan" required style="background-color: #C5C5F2; color: black;">
                    <!-- Menetapkan warna biru pada input dan teks putih -->
                </div>

                <div class="mb-3">
                    <label for="jumlah_pemasukan" class="form-label">Jumlah Pemasukan:</label>
                    <input type="text" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan" required style="background-color: #C5C5F2; color: black;">
                    <!-- Menetapkan warna biru pada input dan teks putih -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kode_pemasukan" class="form-label text-md-end">Kode Pemasukan:</label>
                    <input type="text" class="form-control" id="kode_pemasukan" name="kode_pemasukan" required style="background-color: #C5C5F2; color: black;">
                    <!-- Menetapkan warna biru pada input dan teks putih -->
                </div>

                <div class="mb-3">
                    <label for="dokumentasi" class="form-label text-md-end">Dokumentasi:</label>
                    <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" accept="image/*" style="background-color: #C5C5F2; color: black;">
                    <!-- Menetapkan warna biru pada input dan teks putih -->
                </div>

                <div class="mb-3 text-md-end">
                    <button type="submit" class="btn btn-primary" style="background-color: #BCFF9C; color:black;  border: none;">Tambah Data</button>
                    <!-- Menetapkan warna hijau muda pada tombol -->
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
