@extends('layout_pengunjung.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengeluaran Kas</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk mengubah warna latar belakang */
        body {
            background-color: #FFFFFF; /* Background putih */
        }

        .card {
            background-color: #D6CFBE; /* Warna latar belakang tabel */
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @if(isset($pengeluaranKas))
            @foreach ($pengeluaranKas as $pengeluaran)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">PENGELUARAN KAS</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Judul:</td>
                                        <td>{{ $pengeluaran->jenis_pengeluaran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rincian:</td>
                                        <td>{{ $pengeluaran->jumlah_pengeluaran }}</td>
                                    </tr>
                                </tbody>
                            </table>
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

<!-- Include Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@endsection
