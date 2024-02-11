<!-- resources/views/pemasukan_kas/create.blade.php -->
@extends('layouts.app')
@section('title', 'Tambah pemasukan Kas')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah pemasukan Kas</h1>
    <form action="{{ route('pemasukan_kas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kode_pemasukan" class="form-label">Kode pemasukan:</label>
            <input type="text" class="form-control" id="kode_pemasukan" name="kode_pemasukan" required>
        </div>
        <div class="mb-3">
            <label for="email_user" class="form-label">Email User:</label>
            <input type="text" class="form-control" id="email_user" name="email_user" required>
        </div>
        <div class="mb-3">
            <label for="jenis_pemasukan" class="form-label">Jenis pemasukan:</label>
            <select class="form-select" id="jenis_pemasukan" name="jenis_pemasukan" required>
                <option value="Amal Harian">Amal Harian</option>
                <option value="Sumbangan">Sumbangan</option>
                <option value="Infaq">Infaq</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_pemasukan" class="form-label">Tanggal pemasukan:</label>
            <input type="date" class="form-control" id="tanggal_pemasukan" name="tanggal_pemasukan" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_pemasukan" class="form-label">Jumlah pemasukan:</label>
            <input type="text" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan" required>
        </div>
        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi:</label>
            <input type="file" class="form-control" id="dokumentasi" name="dokumentasi">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
