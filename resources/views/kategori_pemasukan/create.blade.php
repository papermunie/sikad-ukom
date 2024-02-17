@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Kategori Pemasukan</div>

                <div class="card-body">
                    <form action="{{ route('kategori_pemasukan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_kategori_pemasukan">ID Kategori Pemasukan</label>
                            <input type="text" class="form-control" id="id_kategori_pemasukan" name="id_kategori_pemasukan" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pemasukan">Jenis Pemasukan</label>
                            <input type="text" class="form-control" id="jenis_pemasukan" name="jenis_pemasukan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
