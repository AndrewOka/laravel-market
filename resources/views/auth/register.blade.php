@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center w-100 m-0 py-4">
    <div class="col-11 col-sm-10 col-md-8 col-lg-5">
        <div class="card card-glass p-4 p-sm-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Mulai Sekarang</h3>
                <p class="text-light small opacity-75">Daftarkan akun tokomu untuk mulai mengelola stok barang.</p>
            </div>

            <form action="{{ route('register') }}" method="POST" autocomplete="new-password">
                @csrf
                
                {{-- Nama Lengkap --}}
                <div class="mb-3">
                    <label class="form-label text-light opacity-90 small fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control form-control-premium @error('name') is-invalid @enderror" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback small mt-1 text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Alamat Email --}}
                <div class="mb-3">
                    <label class="form-label text-light opacity-90 small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control form-control-premium @error('email') is-invalid @enderror" placeholder="Masukkan email" value="{{ old('email') }}" autocomplete="off" required>
                    @error('email')
                        <div class="invalid-feedback small mt-1 text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="mb-3">
                    <label class="form-label text-light opacity-90 small fw-bold">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control form-control-premium @error('phone') is-invalid @enderror" placeholder="Masukkan nomor telepon" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback small mt-1 text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kata Sandi & Konfirmasi Sandi --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-light opacity-90 small fw-bold">Kata Sandi</label>
                        <input type="password" name="password" class="form-control form-control-premium @error('password') is-invalid @enderror" placeholder="Buat kata sandi" autocomplete="new-password" required>
                        @error('password')
                            <div class="invalid-feedback small mt-1 text-danger fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light opacity-90 small fw-bold">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-premium" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-premium-primary w-100 py-2.5 mb-3 shadow-sm">
                    Buat Akun 
                </button>
                
                <div class="text-center mt-2">
                    <span class="text-light opacity-75 small">Sudah memiliki akun? </span>
                    <a href="{{ route('login') }}" class="small fw-bold text-decoration-none" style="color: #a5b4fc;">Masuk disini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
@endsection