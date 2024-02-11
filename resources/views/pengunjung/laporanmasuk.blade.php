@extends('layout_pengunjung.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemasukan Kas</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Daftar Pemasukan Kas Masjid</h2>
    
 <form action="{{ route('pengunjung.laporanmasuk') }}" method="GET" class="mb-3">
 <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari pengguna..." name="search">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukanKas as $pemasukan)
                <tr>
                    <td>{{ $pemasukan->kode_pemasukan }}</td>
                    <td>{{ $pemasukan->jenis_pemasukan }}</td>
                    <td>{{ $pemasukan->tanggal_pemasukan->format('Y-m-d') }}</td>
                    <td>Rp {{ number_format($pemasukan->jumlah_pemasukan, 0, ',', '.') }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
@endsection