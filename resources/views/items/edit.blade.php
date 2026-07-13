@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 85vh; z-index: 2;">
    <div class="card-premium w-100" style="max-width: 550px; border-radius: 24px; background: #ffffff; padding: 2.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
        
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark m-0" style="letter-spacing: -1px;">Edit Data Barang</h3>
            <p class="text-muted small mt-1 mb-0">Perbarui detail informasi, kategori, dan ketersediaan stok produk</p>
            <hr class="mx-auto my-3" style="width: 50px; height: 3px; background-color: #4f46e5; border: none; border-radius: 10px;">
        </div>

        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label-premium">Nama Barang</label>
                <input type="text" name="name" id="name" class="form-control form-control-premium @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}" placeholder="Contoh: TV Samsung" required autocomplete="off">
                @error('name')
                    <div class="invalid-feedback small fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label-premium">Kategori Produk</label>
                <select name="category_id" id="category_id" class="form-select form-control-premium @error('category_id') is-invalid @enderror" required>
                    <option value="" disabled>-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback small fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6">
                    <label for="price" class="form-label-premium">Harga Satuan (Rp)</label>
                    <div class="input-group-premium">
                        <span class="input-addon">Rp</span>
                        <input type="number" name="price" id="price" class="form-control form-control-premium @error('price') is-invalid @enderror" value="{{ old('price', $item->price) }}" placeholder="0" min="0" required>
                    </div>
                    @error('price')
                        <div class="text-danger small fw-semibold mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-sm-6">
                    <label for="stock" class="form-label-premium">Jumlah Stok</label>
                    <div class="input-group-premium">
                        <input type="number" name="stock" id="stock" class="form-control form-control-premium @error('stock') is-invalid @enderror" value="{{ old('stock', $item->stock) }}" placeholder="0" min="0" required>
                        <span class="input-addon">pcs</span>
                    </div>
                    @error('stock')
                        <div class="text-danger small fw-semibold mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('items.index') }}" class="btn btn-premium-secondary px-4 py-2.5 fw-bold flex-fill text-center text-decoration-none">
                    Kembali
                </a>
                <button type="submit" class="btn btn-premium-primary px-4 py-2.5 fw-bold flex-fill">
                    Perbarui Data
                </button>
            </div>
        </form>

    </div>
</div>

<style>
    /* Gradient Pekat di Layar Belakang */
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

    /* Label Form */
    .form-label-premium {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Input Styling */
    .form-control-premium {
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px !important;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 500;
        transition: all 0.2s ease;
        background-color: #fff;
    }
    .form-control-premium:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
        outline: none;
    }

    /* Input Group Khusus Berdampingan dengan Teks Rp / pcs */
    .input-group-premium {
        display: flex;
        align-items: center;
        position: relative;
    }
    .input-group-premium .form-control-premium {
        flex: 1;
    }
    .input-group-premium :first-child:not(.form-control-premium) {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        border-right: none;
    }
    .input-group-premium :last-child:not(.form-control-premium) {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
        border-left: none;
    }
    .input-addon {
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        padding: 0.65rem 0.85rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
    }

    /* Tombol Utama Premium (Ungu Indigo Gradasi) */
    .btn-premium-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6) !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25) !important;
        transition: all 0.2s ease;
    }
    .btn-premium-primary:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35) !important;
        transform: translateY(-1px);
    }

    /* Tombol Batal / Kembali (Abu-abu Slate Muted) */
    .btn-premium-secondary {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    .btn-premium-secondary:hover {
        background-color: #e2e8f0 !important;
        color: #1e293b !important;
    }
</style>
@endsection