@extends('layouts.app')

@section('content')

<div class="row justify-content-center align-items-center w-100 m-0">
    <div class="col-11 col-sm-9 col-md-6 col-lg-4">
        <div class="card card-glass p-4 p-sm-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Selamat Datang</h3>
                <p class="text-light small opacity-75">Kelola operasional toko dengan lebih cepat dan mudah.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger bg-danger bg-opacity-20 border-0 text-white small py-2 rounded-3 text-center mb-3">
                    ❌ Email atau password salah.
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light opacity-90 small fw-bold">Alamat Email</label>
                    <input type="email" name="email" class="form-control form-control-premium" placeholder="name@company.com" autocomplete="off" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-light opacity-90 small fw-bold mb-1">Kata Sandi</label>
                    <input type="password" name="password" class="form-control form-control-premium" placeholder="••••••••" autocomplete="new-password" required>
                </div>
                
                <button type="submit" class="btn btn-premium-primary w-100 py-2.5 mb-3 shadow-sm">
                    Masuk ke Dashboard
                </button>
                
                <div class="text-center mt-2">
                    <span class="text-light opacity-75 small">Belum terdaftar? </span>
                    <a href="{{ route('register') }}" class="small fw-bold text-decoration-none" style="color: #a5b4fc;">Buat akun baru</a>
                </div>
            </form>
        </div>
    </div>
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@endsection