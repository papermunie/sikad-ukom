@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Kategori Pengeluaran</div>

                <div class="card-body">
                    <form action="{{ route('kategori_pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_kategori_pengeluaran">ID Kategori Pengeluaran</label>
                            <input type="text" class="form-control" id="id_kategori_pengeluaran" name="id_kategori_pengeluaran" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                            <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
