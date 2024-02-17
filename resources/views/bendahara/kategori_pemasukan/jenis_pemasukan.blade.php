@extends('layout_bendahara.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kategori Pemasukan</div>

                <div class="card-body">
                    <a href="{{ route('bendahara.kategori_pemasukan.create') }}" class="btn btn-primary mb-3">Tambah Kategori Pemasukan</a>

                    @if ($kategoriPemasukan->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Pemasukan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoriPemasukan as $kategori)
                                    <tr>
                                        <td>{{ $kategori->id_kategori_pemasukan }}</td>
                                        <td>{{ $kategori->jenis_pemasukan }}</td>
                                        <td>
                                            <a href="{{ route('bendahara.kategori_pemasukan.edit', $kategori->id_kategori_pemasukan) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('bendahara.kategori_pemasukan.destroy', $kategori->id_kategori_pemasukan) }}" method="POST" class="d-inline">
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
                        <p>Tidak ada kategori pemasukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $kategoriPemasukan->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
