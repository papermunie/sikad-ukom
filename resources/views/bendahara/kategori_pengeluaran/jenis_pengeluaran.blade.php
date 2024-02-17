@extends('layout_bendahara.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kategori Pengeluaran</div>

                <div class="card-body">
                    <a href="{{ route('bendahara.kategori_pengeluaran.create') }}" class="btn btn-primary mb-3">Tambah Kategori Pengeluaran</a>

                    @if ($kategoriPengeluaran->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoriPengeluaran as $kategori)
                                    <tr>
                                        <td>{{ $kategori->id_kategori_pengeluaran }}</td>
                                        <td>{{ $kategori->jenis_pengeluaran }}</td>
                                        <td>
                                            <a href="{{ route('bendahara.kategori_pengeluaran.edit', $kategori->id_kategori_pengeluaran) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('bendahara.kategori_pengeluaran.destroy', $kategori->id_kategori_pengeluaran) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada kategori pengeluaran.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $kategoriPengeluaran->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
