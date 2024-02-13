
@extends('layout_bendahara.app')
@section('title', 'Tambah Pengeluaran Kas')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah Pengeluaran Kas</h1>
    <form action="{{ route('pengeluaran_kas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kode_pengeluaran" class="form-label">Kode Pengeluaran:</label>
            <input type="text" class="form-control" id="kode_pengeluaran" name="kode_pengeluaran" required>
        </div>
        <div class="mb-3">
            <label for="email_user" class="form-label">Email User:</label>
            <input type="text" class="form-control" id="email_user" name="email_user" required>
        </div>
        <div class="mb-3">
            <label for="jenis_pengeluaran" class="form-label">Jenis Pengeluaran:</label>
            <input type="string" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran:</label>
            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_pengeluaran" class="form-label">Jumlah Pengeluaran:</label>
            <input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
