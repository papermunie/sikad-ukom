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
            <div class="col-md-4 mb-3">
            <a href="{{ route('bendahara.pemasukan.index') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header">
                        <b>LAPORAN PEMASUKAN KAS</b>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-4 mb-1">
            <a href="{{ route('bendahara.kategori_pemasukan.jenis_pemasukan') }}" class="text-decoration-none">
                <div class="card text-dark" style="background-color: #C5C5F1; text-align: center;">
                    <div class="card-header"><b>JENIS PEMASUKAN KAS</b></div>
                </div>
            </div>
            </a>
        </div>
</div>

@endsection