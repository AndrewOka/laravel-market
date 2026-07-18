@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 80vh; z-index: 2;">
    <div class="card-premium w-100" style="max-width: 550px; border-radius: 24px; background: #ffffff; padding: 2rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
        
        <div class="mb-4 text-center">
            <h3 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">Tambah Barang Baru</h3>
            <p class="text-muted small mt-1">Masukkan detail data produk secara lengkap dan benar</p>
            <hr class="mx-auto my-3" style="width: 60px; height: 3px; background-color: #4f46e5; border: none; border-radius: 10px;">
        </div>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="mb-3">
    <label for="code" class="form-label fw-semibold text-secondary small mb-2">Kode Barang</label>
    <input type="text" name="code" id="code" class="form-control form-control-premium text-muted" 
           value="{{ old('code', $autoCode) }}" readonly style="background-color: #f8fafc; cursor: not-allowed;">
    @error('code')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

            <div class="mb-3">
                <label class="form-label fw-bold text-secondary small mb-1.5">Nama Barang</label>
                <input type="text" name="name" class="form-control-premium w-100" placeholder="Contoh: Kemeja Flanel" required autocomplete="off" style="border-radius: 12px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1;">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold text-secondary small mb-1.5">Kategori Produk</label>
                <select name="category_id" class="form-select form-control-premium w-100" style="cursor: pointer; border-radius: 12px; padding: 0.6rem 1rem; border: 1px solid #cbd5e1;" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-3 mb-4">
    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold text-secondary small mb-2">Harga Satuan</label>
        <div class="input-group input-group-premium">
            <span class="input-group-text premium-addon">Rp</span>
            <input type="number" name="price" id="price" class="form-control form-control-premium" placeholder="0" min="0" value="{{ old('price') }}" required autocomplete="off">
        </div>
        @error('price')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="stock" class="form-label fw-semibold text-secondary small mb-2">Jumlah Stok</label>
        <div class="input-group input-group-premium">
            <input type="number" name="stock" id="stock" class="form-control form-control-premium text-end" placeholder="0" min="0" value="{{ old('stock') }}" required autocomplete="off">
            <span class="input-group-text premium-addon">Pcs</span>
        </div>
        @error('stock')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

            <div class="d-flex gap-3 mt-2">
                <a href="{{ route('items.index') }}" class="btn btn-light fw-bold w-50 py-2.5 text-secondary" style="border-radius: 12px; font-size: 0.95rem; border: 1px solid #e2e8f0; transition: all 0.2s;">
                    Kembali
                </a>
                
                <button type="submit" class="btn-premium-primary w-50 py-2.5">
                    Simpan Barang
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/items/create.css') }}?v={{ time() }}">
@endpush