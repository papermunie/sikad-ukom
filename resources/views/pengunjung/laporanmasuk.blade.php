    @extends('layout_pengunjung.app')

    @section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Pemasukan Kas</title>
        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Custom CSS untuk mengubah warna latar belakang dan posisi navbar */
            body {
                background-color: #FFFFFF; /* Background putih */
            }
    
            .navbar {
                position: relative; /* Posisi navbar di atas */
                z-index: 1000; /* Menempatkan navbar di atas konten lain */
            }
    
            .content-container {
                margin-top: 80px; /* Mengatur jarak antara navbar dan konten tabel */
                text-align: center; /* Mengatur tabel di tengah */
            }
    
            .table {
                background-color: #A0A0F3; /* Warna tabel */
            }
        </style>
    </head>
    
    <div class="container content-container mt-5">
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
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
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
  
        <div class="d-flex justify-content-center">
            {{ $pemasukanKas->links('pagination::bootstrap-5') }}
        </div>
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
    </html>
    @endsection
    