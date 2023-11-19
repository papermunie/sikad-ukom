<!-- resources/views/pengeluaran/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Kas Masuk</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pengeluaran.update', ['pengeluaran' => $PengeluaranKas->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $PengeluaranKas->nama }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $PengeluaranKas->jumlah }}" required>
                            </div>

                            <!-- Tambahkan kolom lain sesuai kebutuhan -->

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
