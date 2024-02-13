@extends('layout_bendahara.app')

@section('content')
    <div class="container mt-4">
        <h2>Detail pemasukan</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kode pemasukan: {{ $pemasukan->kode_pemasukan }}</h5>
                <p class="card-text">Jenis pemasukan: {{ $pemasukan->jenis_pemasukan }}</p>
                <p class="card-text">Tanggal pemasukan: {{ $pemasukan->tanggal_pemasukan->format('Y-m-d') }}</p>
                <p class="card-text">Jumlah pemasukan: {{ $pemasukan->jumlah_pemasukan }}</p>
                </p>
                <a href="{{ route('bendahara.pemasukan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
