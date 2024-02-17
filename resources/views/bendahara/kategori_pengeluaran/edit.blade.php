@extends('layout_bendahara.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kategori Pengeluaran</div>

                <div class="card-body">
                    <form action="{{ route('bendahara.kategori_pengeluaran.update', $kategoriPengeluaran->id_kategori_pengeluaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jenis_pengeluaran">Jenis Pengeluaran</label>
                            <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" value="{{ $kategoriPengeluaran->jenis_pengeluaran }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
