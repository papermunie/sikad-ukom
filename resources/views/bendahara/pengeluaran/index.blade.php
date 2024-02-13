@extends('layout_bendahara.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data pengeluaran Kas</h2>
        <div>
            <a href="{{ route('bendahara.pengeluaran.create') }}" class="btn btn-primary">Tambah pengeluaran</a>
            <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
        </div>
    </div>

    <form action="{{ route('bendahara.pengeluaran.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari pengguna..." name="search">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered" style="background-color: #A0A0F3;">
        <thead>
            <tr>
                <th>Kode pengeluaran</th>
                <th>Jenis pengeluaran</th>
                <th>Tanggal pengeluaran</th>
                <th>Jumlah pengeluaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $data)
            <tr>
                <td>{{ $data->kode_pengeluaran }}</td>
                <td>{{ $data->jenis_pengeluaran }}</td>
                <td>{{ $data->tanggal_pengeluaran->format('Y-m-d') }}</td>
                <td>Rp {{ number_format($data->jumlah_pengeluaran, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('bendahara.pengeluaran.show', $data->kode_pengeluaran) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('bendahara.pengeluaran.edit', $data->kode_pengeluaran) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('bendahara.pengeluaran.destroy', $data->kode_pengeluaran) }}" method="POST" style="display: inline-block;">
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
