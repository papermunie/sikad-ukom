@extends('layout_bendahara.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data pemasukan Kas</h2>
        <div>
            <a href="{{ route('bendahara.pemasukan.create') }}" class="btn btn-primary">Tambah pemasukan</a>
            <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
        </div>
    </div>

    <form action="{{ route('bendahara.pemasukan.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari pengguna..." name="search">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered" style="background-color: #A0A0F3;">
        <thead>
            <tr>
                <th>Kode pemasukan</th>
                <th>Jenis pemasukan</th>
                <th>Tanggal pemasukan</th>
                <th>Jumlah pemasukan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukan as $data)
            <tr>
                <td>{{ $data->kode_pemasukan }}</td>
                <td>{{ $data->jenis_pemasukan }}</td>
                <td>{{ $data->tanggal_pemasukan->format('Y-m-d') }}</td>
                <td>Rp. {{ number_format($data->jumlah_pemasukan, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('bendahara.pemasukan.show', $data->kode_pemasukan) }}"
                        class="btn btn-info">Detail</a>
                    <a href="{{ route('bendahara.pemasukan.edit', $data->kode_pemasukan) }}"
                        class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
