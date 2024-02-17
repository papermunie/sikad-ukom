@extends('layout_bendahara.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kategori Pemasukan</div>

                <div class="card-body">
                    <form action="{{ route('bendahara.kategori_pemasukan.update', $kategoripemasukan->id_kategori_pemasukan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jenis_pemasukan">Jenis Pemasukan</label>
                            <input type="text" class="form-control" id="jenis_pemasukan" name="jenis_pemasukan" value="{{ $kategoripemasukan->jenis_pemasukan }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
