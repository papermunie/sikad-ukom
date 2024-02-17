@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kategori Pemasukan</div>

                <div class="card-body">
                    <a href="{{ route('kategori_pemasukan.create') }}" class="btn btn-primary mb-3">Tambah Kategori Pemasukan</a>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
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
                                            <a href="{{ route('kategori_pemasukan.edit', $kategori->id_kategori_pemasukan) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete('form{{ $kategori->id_kategori_pemasukan }}')">Hapus</button>

                                            <form id="form{{ $kategori->id_kategori_pemasukan }}" action="{{ route('kategori_pemasukan.destroy', $kategori->id_kategori_pemasukan) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   function confirmDelete(formId) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endsection
