<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Aplikasi Pengelola Sistem Keuangan</h2>
                <h3>Masjid Secara Praktis</h3>
                <h3>for masjid adz-dzikru</h3>

                <!-- Tambahkan gambar di sini -->
                <img src="{{ asset('public/images/masjid.png') }}" class="img-fluid mt-3">
            </div>
        </div>
    </div>
@endsection
