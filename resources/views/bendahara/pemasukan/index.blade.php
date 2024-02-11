
@extends('layout_bendahara.app')

@section('content')
    <div class="container mt-4">
        <h2>Data Pemasukan Kas</h2>
        <a href="{{ route('bendahara.pemasukan.create') }}" class="btn btn-primary mb-3">Tambah Pemasukan</a>

 <form action="{{ route('bendahara.pemasukan.index') }}" method="GET" class="mb-3">
 <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari pengguna..." name="search">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode pemasukan</th>
                        <th>Jenis pemasukan</th>
                        <th>Tanggal pemasukan</th>
                        <th>Jumlah pemasukan</th>
                        <th>Dokumentasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukan as $pemasukan)
                        <tr>
                            <td>{{ $pemasukan->kode_pemasukan }}</td>
                            <td>{{ $pemasukan->jenis_pemasukan }}</td>
                            <td>{{ $pemasukan->tanggal_pemasukan->format('Y-m-d') }}</td>
                            <td>Rp. {{ number_format($pemasukan->jumlah_pemasukan, 0, ',', '.') }}</td>
                            <td>
                                <img src="{{ url('dokumentasi') . '/' . $pemasukan->dokumentasi }} "
                                    style="width: 200px; height: 250px;" alt="dokumentasi" />
                            </td>
                            <td>
                                <a href="{{ route('bendahara.pemasukan.show', $pemasukan->kode_pemasukan) }}"
                                    class="btn btn-info">Detail</a>
                                <a href="{{ route('bendahara.pemasukan.edit', $pemasukan->kode_pemasukan) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('bendahara.pemasukan.destroy', $pemasukan->kode_pemasukan) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endsection        