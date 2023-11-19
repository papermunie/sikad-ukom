<!-- resources/views/pengeluaran/create.blade.php -->

@extends('layouts.app') <!-- Jika Anda menggunakan layout -->

@section('content')
    <div class="container">
        <h2>Tambah Data Kas Masuk</h2>
        <form action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf
            <div class="form-group">
                                <label for="nama">Kode Pengeluaran</label>
                                <input type="text" class="form-control" id="kode" name="kode" required>
                            </div>
                            <label>Jenis Surat</label>
                                    <select name="id_kategori_pengeluaran" id="kategoriPengeluaran" class="form-select mb-3">
                                        <option selected value="">Pilih jenis surat</option>
                                    </select>
                                    <label>Tanggal Surat</label>
                                    <input type="datetime-local" name="tanggal_surat" id="tanggalSurat"
                                           class="form-control mb-3">
                                           <div class="form-group">
                                <label for="nama">Jumlah Pengeluaran</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
            <!-- Tambahkan field lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
