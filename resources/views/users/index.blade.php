@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">User List</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Data User</a>
     <!-- Notifikasi -->
     @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
    </form>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center" style="background-color: blue;">
                <th scope="col">No</th>
                <th scope="col">Email</th>
                <th scope="col">Foto Profil</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            $count = 1;
            // Array untuk mapping role dari database ke format yang diinginkan di tampilan
            $roleLabels = [
                'ketua_dkm' => 'Ketua DKM',
                'bendahara' => 'Bendahara',
                'warga_sekolah' => 'Warga Sekolah'
            ];
        @endphp  
            @php
                $count = 1;
            @endphp
            @foreach($users as $user)
                <tr class="text-center {{ $count % 2 == 0 ? 'table-primary' : '' }}">
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $user->email_user }}@gmail.com</td>
                    <td>
                        <img src="{{ url('foto_profil') . '/' . $user->foto_profil }} "
                            style="width: 200px; height: 250px;" alt="foto_profil" />
                    </td>
                    <td class="align-middle">{{ $roleLabels[$user->role] }}</td> <!-- Menggunakan mapping role -->
                    <td class="align-middle">
                        <a href="{{ route('users.edit', $user->email_user) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('users.show', $user->email_user) }}" class="btn btn-info btn-sm">Detail</a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('form{{ $user->email_user }}')">Hapus</button>

<form id="form{{ $user->email_user }}" action="{{ route('users.destroy', $user->email_user) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
                    </td>
                </tr>
                @php
                    $count++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>
<!-- Tambahkan di head atau sebelum menutup </body> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Fungsi untuk menampilkan SweetAlert saat menghapus data
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

