@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/categoris/create.css') }}?v={{ time() }}">

@section('content')
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
                
                <button type="submit" class="btn btn-premium-primary w-50 py-2.5">
                    Simpan Kategori
                </button>
            </div>
        </form>

    </div>
</div>
@endsection