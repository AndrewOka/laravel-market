@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 75vh; z-index: 2;">
    <div class="card-premium w-100" style="max-width: 480px; border-radius: 24px; background: #ffffff; padding: 2rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
        
        <div class="mb-4 text-center">
            <h3 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">Tambah Kategori</h3>
            <hr class="mx-auto my-3" style="width: 50px; height: 3px; background-color: #4f46e5; border: none; border-radius: 10px;">
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label fw-bold text-secondary small mb-1.5">Nama Kategori</label>
                <input type="text" name="name" class="form-control-premium w-100" placeholder="Contoh: Elektronik, Pakaian, Makanan" required autocomplete="off" autofocus style="border-radius: 12px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1;">
            </div>

            <div class="d-flex gap-3 mt-2">
                <a href="{{ route('categories.index') }}" class="btn btn-light fw-bold w-50 py-2.5 text-secondary" style="border-radius: 12px; font-size: 0.95rem; border: 1px solid #e2e8f0; transition: all 0.2s;">
                    Kembali
                </a>
                
                <button type="submit" class="btn-premium-primary w-50 py-2.5">
                    Simpan Kategori
                </button>
            </div>
        </form>

    </div>
</div>

<style>
    .mesh-gradient-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: 
            radial-gradient(circle at 85% 15%, rgba(79, 70, 229, 0.45) 0%, transparent 55%), 
            radial-gradient(circle at 15% 85%, rgba(107, 33, 168, 0.42) 0%, transparent 55%);
        z-index: 1;
        pointer-events: none;
        background-color: #f1f5f9;
    }

    .btn-premium-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6) !important;
        color: white !important;
        font-weight: 600;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        transition: all 0.2s ease;
    }
    .btn-premium-primary:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4) !important;
        transform: translateY(-1px);
    }
</style>
@endsection