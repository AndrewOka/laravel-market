@extends('layouts.app')

@section('content')
<style>
    /* Mengatur body agar gambar dan filter gelap memenuhi seluruh layar tanpa terpotong */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    
    body {
        background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)), 
                    url('https://cdn.corenexis.com/f/Sb7JMMJPaPf.jpg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    /* Efek Kaca Transparan Penuh (Glassmorphism Luxury) */
    .card-glass {
        background: rgba(30, 41, 59, 0.45) !important; /* Semi transparan gelap */
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    /* Input Diubah Semi Transparan Agar Menyatu */
    .form-control-premium {
        background-color: rgba(255, 255, 255, 0.07) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        color: #ffffff !important;
        transition: all 0.2s ease;
    }
    .form-control-premium::placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }
    .form-control-premium:focus {
        background-color: rgba(255, 255, 255, 0.12) !important;
        border-color: #818cf8 !important;
        box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.25) !important;
    }

    .btn-premium-primary {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #ffffff;
        font-weight: 600;
        border-radius: 12px;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-premium-primary:hover {
        background: linear-gradient(135deg, #4338ca, #4f46e5);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }
</style>

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
@endsection