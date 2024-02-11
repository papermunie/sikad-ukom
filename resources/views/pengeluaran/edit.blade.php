@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Edit pengeluaran</h2>

        <form action="{{ route('pengeluaran.update', $pengeluaran->kode_pengeluaran) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kode_pengeluaran" class="form-label">Kode pengeluaran</label>
                <input type="text" class="form-control" id="kode_pengeluaran" name="kode_pengeluaran"
                    value="{{ $pengeluaran->kode_pengeluaran }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="jenis_pengeluaran" class="form-label">Jenis pengeluaran</label>
                <select class="form-select" id="jenis_pengeluaran" name="jenis_pengeluaran">
                    <option value="Amal Harian" @if ($pengeluaran->jenis_pengeluaran == 'Amal Harian') selected @endif>Amal Harian</option>
                    <option value="Sumbangan" @if ($pengeluaran->jenis_pengeluaran == 'Sumbangan') selected @endif>Sumbangan</option>
                    <option value="Infaq" @if ($pengeluaran->jenis_pengeluaran == 'Infaq') selected @endif>Infaq</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_pengeluaran" class="form-label">Tanggal pengeluaran</label>
                <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran"
                    value="{{ $pengeluaran->tanggal_pengeluaran->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_pengeluaran" class="form-label">Jumlah pengeluaran</label>
                <input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                    value="{{ $pengeluaran->jumlah_pengeluaran }}" required>
            </div>
            <div class="mb-3">
                <label for="dokumentasi" class="form-label">Dokumentasi</label>
                <br>
                <img src="{{ url('dokumentasi') . '/' . $pengeluaran->dokumentasi }} " style="width: 200px; height: 250px;"
                    alt="Profile" />
                <input type="file" name="dokumentasi" id="dokumentasi" class="form-control mt-3">
            </div>

            {{-- arahan sopi --}}
            {{-- <td class="col-2"> 
                @foreach (explode(',', $pnlr->foto) as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="Foto" class="img-fluid" style="max-width: 100px;">
                @endforeach
            </td> --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        @endsection


