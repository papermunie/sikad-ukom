@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 style="color: #A0A0F3;">Edit pemasukan</h2>

        <form action="{{ route('pemasukan.update', $pemasukan->kode_pemasukan) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kode_pemasukan" class="form-label" style="color: #A0A0F3;">Kode pemasukan</label>
                <input type="text" class="form-control" id="kode_pemasukan" name="kode_pemasukan"
                    value="{{ $pemasukan->kode_pemasukan }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_pemasukan" class="form-label" style="color: #A0A0F3;">Jenis pemasukan</label>
                <select class="form-select" id="jenis_pemasukan" name="jenis_pemasukan">
                    <option value="Amal Harian" @if ($pemasukan->jenis_pemasukan == 'Amal Harian') selected @endif style="color: #A0A0F3;">Amal Harian</option>
                    <option value="Sumbangan" @if ($pemasukan->jenis_pemasukan == 'Sumbangan') selected @endif style="color: #A0A0F3;">Sumbangan</option>
                    <option value="Infaq" @if ($pemasukan->jenis_pemasukan == 'Infaq') selected @endif style="color: #A0A0F3;">Infaq</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_pemasukan" class="form-label" style="color: #A0A0F3;">Tanggal pemasukan</label>
                <input type="date" class="form-control" id="tanggal_pemasukan" name="tanggal_pemasukan"
                    value="{{ $pemasukan->tanggal_pemasukan->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_pemasukan" class="form-label" style="color: #A0A0F3;">Jumlah pemasukan</label>
                <input type="text" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan"
                    value="{{ $pemasukan->jumlah_pemasukan }}" required>
            </div>
            <div class="mb-3">
                <label for="dokumentasi" class="form-label" style="color: #A0A0F3;">Dokumentasi</label>
                <br>
                <img src="{{ url('dokumentasi') . '/' . $pemasukan->dokumentasi }} " style="width: 200px; height: 250px;"
                    alt="Profile" />
                <input type="file" name="dokumentasi" id="dokumentasi" class="form-control mt-3">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        @endsection
