@extends('layout_pengunjung.app')

@section('content')

<style>
    .vertical-center {
        min-height: 75vh;
        max-width: 105vh;
        display: flex;
        flex-direction: column;
        justify-content: center; 
    }
</style>
<div class="container mx-auto my-5 vertical-center"> <!-- Gunakan class vertical-center yang telah ditambahkan -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 mb-4">
            <a href="{{ route('pengunjung.laporanmasuk') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header">
                        <b>LAPORAN PEMASUKAN</b>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('warga.png') }}" width='100px' style="margin: 0 auto; display: block;">
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-5 mb-4">
            <a href="{{ route('pengunjung.laporankeluar') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header"><b>LAPORAN PENGELUARAN</b></div>
                    <div class="card-body">
                        <img src="{{ asset('warga.png') }}" width='100px' style="margin: 0 auto; display: block;">
                    </div>
                </div>
            </div>
            </a>
        </div>
</div>

@endsection