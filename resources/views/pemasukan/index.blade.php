@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pemasukan Kas</h2>
        <div>
            <a href="{{ route('pemasukan.create') }}" class="btn btn-primary ">Tambah Pemasukan</a>
            <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
        </div>
    </div>

    <form action="{{ route('pemasukan.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari pengguna..." name="search">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered" style="background-color: #A0A0F3; class=mb-3; ">
        <thead>
            <tr>
                <th>Kode Pemasukan</th>
                <th>Jenis Pemasukan</th>
                <th>Tanggal Pemasukan</th>
                <th>Jumlah Pemasukan</th>
                <th>Dokumentasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($pemasukan as $data)
            <tr>
                <td>{{ $data->kode_pemasukan }}</td>
                <td>{{ $data->jenis_pemasukan }}</td>
                <td>{{ $data->tanggal_pemasukan->format('Y-m-d') }}</td>
                <td>Rp {{ number_format($data->jumlah_pemasukan, 0, ',', '.') }}</td>
                <td>
                    @if ($data->dokumentasi)
                    <img src="{{ url('dokumentasi') . '/' . $data->dokumentasi }}" style="width: 200px; height: 250px;" alt="Dokumentasi" />
                    @else
                    Tidak ada dokumentasi
                    @endif
                </td>
                <td>
                    <a href="{{ route('pemasukan.show', $data->kode_pemasukan) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('pemasukan.edit', $data->kode_pemasukan) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pemasukan.destroy', $data->kode_pemasukan) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
