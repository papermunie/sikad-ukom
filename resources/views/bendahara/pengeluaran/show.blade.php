@extends('layout_bendahara.app')

@section('content')
    <div class="container mt-4">
        <h2>Detail pengeluaran</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kode pengeluaran: {{ $pengeluaran->kode_pengeluaran }}</h5>
                <p class="card-text">Jenis pengeluaran: {{ $pengeluaran->jenis_pengeluaran }}</p>
                <p class="card-text">Tanggal pengeluaran: {{ $pengeluaran->tanggal_pengeluaran->format('Y-m-d') }}</p>
                <p class="card-text">Jumlah pengeluaran: {{ $pengeluaran->jumlah_pengeluaran }}</p>
                </p>
                <a href="{{ route('bendahara.pengeluaran.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
