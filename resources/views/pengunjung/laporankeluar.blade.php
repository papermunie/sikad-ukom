@extends('layout_pengunjung.app')

@section('content')
<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-4 g-4">
    @if(isset($pengeluaranKas))
    @foreach ($pengeluaranKas as $pengeluaran)
            <div class="col">
                <div class="card h-100">
                @if($pengeluaran->dokumentasi)
                <img src="{{ asset('path/to/dokumentasi/' . $pengeluaran->dokumentasi) }}">
                        @else
                            Tidak Ada Dokumentasi
                        @endif
                  
                    <div class="card-body">
                        <h5 class="card-title">{{ $pengeluaran->jenis_pengeluaran }}</h5>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $pengeluaran->tanggal_pengeluaran }}</small>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>
@endsection