@extends('layout_bendahara.app')

@section('title', 'Tambah Data pemasukan Kas')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data pemasukan Kas</h1>
    <form action="{{ route('bendahara.pemasukan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kode_pemasukan" class="form-label">Kode pemasukan:</label>
            <input type="string" class="form-control" id="kode_pemasukan" name="kode_pemasukan" required>
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

        <!-- buat angka ga banyak -->
        <div class="input-group input-group-sm mb-3">
            <label for="jumlah_pemasukan" class="form-label">Jumlah pemasukan:</label>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                    name="jumlah_pemasukan">
            </div>

        </div>

        {{-- arahan dari sopi --}}
        <label>Foto</label>
        <input type="file" class="form-control mb-3" id="Foto" name="dokumentasi" required>

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
    @endsection