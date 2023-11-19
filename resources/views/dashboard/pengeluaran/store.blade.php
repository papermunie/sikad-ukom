<!-- resources/views/pengeluaran/store.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Tambah Data Kas Keluar
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pengeluaran.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Kode Pengeluaran</label>
                                <input type="text" class="form-control" id="kode" name="kode" required>
                            </div>
                            <label>Jenis Surat</label>
                                    <select name="id_kategori_pengeluaran" id="kategoriPengeluaran" class="form-select mb-3">
                                        <option selected value="">Pilih jenis surat</option>
                                        @foreach($kategori_pengeluaran as $kp)
                                            <option value="{{$kp->id}}">{{$kp->kategori_pengeluaran}}</option>
                                        @endforeach
                                    </select>
                                    <label>Tanggal Surat</label>
                                    <input type="datetime-local" name="tanggal_surat" id="tanggalSurat"
                                           class="form-control mb-3">
                                           <div class="form-group">
                                <label for="nama">Jumlah Pengeluaran</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
                            <!-- Tambahkan field lainnya sesuai kebutuhan -->

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
