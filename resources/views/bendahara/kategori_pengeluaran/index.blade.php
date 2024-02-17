@extends('layout_bendahara.app')

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
            <a href="{{ route('bendahara.pengeluaran.index') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header">
                        <b>LAPORAN PENGELUARAN KAS</b>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-5 mb-4">
            <a href="{{ route('bendahara.kategori_pengeluaran.jenis_pengeluaran') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header"><b>JENIS PENGELUARAN KAS</b></div>
                </div>
            </div>
            </a>
        </div>
</div>

@endsection