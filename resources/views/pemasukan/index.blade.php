@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pemasukan Kas</h2>
        <div>
            <a href="{{ route('pemasukan.create') }}" class="btn btn-primary">Tambah pemasukan</a>
            <button onclick="cetak()" class="btn btn-secondary">Cetak</button>
        </div>
    </div>
     <!-- Notifikasi -->
     @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('pemasukan.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari data pemasukan..." name="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered mx-auto" style="background-color: #A0A0F3;">
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
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('form{{ $data->kode_pemasukan }}')">Hapus</button>

<form id="form{{ $data->kode_pemasukan }}" action="{{ route('pemasukan.destroy', $data->kode_pemasukan) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $pemasukan->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Load jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
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

    function cetak() {
        // Buat instance jsPDF
        const doc = new jsPDF();

        // Tambahkan konten yang ingin dicetak
        doc.text("Daftar Kategori Pemasukan", 10, 10);
        doc.autoTable({ html: 'table' });

        // Cetak dokumen
        doc.save('daftar_kategori_pemasukan.pdf');
    }
</script>

@endsection
