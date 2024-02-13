
@extends('layout_bendahara.app')

@section('title', 'Tambah Data pengeluaran Kas')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data pengeluaran Kas</h1>
    <form action="{{ route('bendahara.pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kode_pengeluaran" class="form-label">Kode pengeluaran:</label>
            <input type="string" class="form-control" id="kode_pengeluaran" name="kode_pengeluaran" required>
        </div>

        <div class="mb-3">
            <label for="jenis_pengeluaran" class="form-label">Jenis pengeluaran:</label>
            <input type="string" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal pengeluaran:</label>
            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" required>
        </div>

        <!-- buat angka ga banyak -->
        <div class="input-group input-group-sm mb-3">
            <label for="jumlah_pengeluaran" class="form-label">Jumlah pengeluaran:</label>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                    name="jumlah_pengeluaran">
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
    @endsection