@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-between align-items-center mb-4 position-relative" style="z-index: 2;">
    <div>
        <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -1px;">Manajemen Barang</h2>
        <p class="text-muted small mb-0">Kelola stok dan pantau kondisi ketersediaan produk Anda</p>
    </div>
    <a href="{{ route('items.create') }}" class="btn btn-premium-primary text-decoration-none">
        + Tambah Barang Baru
    </a>
</div>

<div class="row g-4 mb-4 position-relative" style="z-index: 2;">
    <div class="col-12 col-md-6">
        <div class="card-stat-premium">
            <div>
                <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Produk</small>
                <h4 class="fw-bold mb-0 mt-1 text-dark" style="letter-spacing: -0.5px;">
                    {{ method_exists($items, 'total') ? $items->total() : $items->count() }} <span class="fs-6 fw-normal text-muted">Item</span>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card-stat-premium">
            <div>
                <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Kondisi Stok</small>
                <h4 class="fw-bold mb-0 mt-1 text-dark" style="letter-spacing: -0.5px;">
                    @php
                        $stokHabis = $items->where('stock', 0)->count();
                    @endphp
                    @if($stokHabis > 0)
                        <span class="text-danger">{{ $stokHabis }} Habis</span>
                    @else
                        <span class="text-success">Aman</span>
                    @endif
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="card-premium position-relative" style="z-index: 2; border-radius: 24px;">
    <form action="{{ route('items.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4 d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-premium" placeholder="Cari nama barang..." value="{{ request('search') }}" autocomplete="off">
            <button type="submit" class="btn btn-premium-primary px-4">Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
            <thead class="table-light text-uppercase fs-7 text-secondary" style="letter-spacing: 0.75px; font-size: 0.8rem;">
                <tr>
                    <th class="py-3 px-4" style="border-radius: 10px 0 0 10px;">Nama Barang</th>
                    <th class="py-3">Kategori</th>
                    <th class="py-3">Harga</th>
                    <th class="py-3">Stok</th>
                    <th class="py-3 text-end px-4" style="border-radius: 0 10px 10px 0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr class="premium-row">
                    <td class="fw-bold py-3.5 px-4 text-dark">
                        {{ $item->name }}
                    </td>
                    <td>
                        <span class="badge bg-light text-primary border border-primary-subtle px-3 py-1.5 rounded-pill fw-semibold" style="font-size: 0.8rem;">
                            {{ $item->category->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>
                    <td class="text-muted fw-semibold">
                        Rp {{ number_format($item->price, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="fw-bold {{ $item->stock == 0 ? 'text-danger' : 'text-dark' }}">{{ $item->stock }}</span> 
                        <span class="text-muted small fw-medium">pcs</span>
                    </td>
                    <td class="text-end px-4">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-3 me-1 px-3 fw-bold" style="font-size: 0.85rem; border-radius: 10px !important;">Edit</a>
                        
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline form-hapus-barang">
                            @csrf 
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-3 px-3 fw-bold btn-pemicu-hapus" style="font-size: 0.85rem; border-radius: 10px !important;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted fw-medium">
                        🔍 Belum ada data produk yang cocok atau tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($items, 'links'))
        <div class="custom-pagination mt-4 d-flex justify-content-start">
            {{ $items->links('pagination::bootstrap-4') }}
        </div>
    @endif
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
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
    }

    .card-stat-premium {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-stat-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.05);
    }

    .premium-row {
        transition: background-color 0.2s ease;
    }
    .premium-row:hover {
        background-color: #f8fafc !important;
    }

    /* CSS CUSTOM UNTUK PAGINATION KOTAK MODERN */
    .custom-pagination nav p {
        display: none !important; /* Hilangkan teks "Showing X to Y..." */
    }
    .custom-pagination .pagination {
        gap: 6px;
        margin: 0;
        padding: 0;
    }
    .custom-pagination .page-item .page-link {
        background-color: #ffffff !important;
        color: #4f46e5 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02) !important;
    }
    /* Hover tombol */
    .custom-pagination .page-item .page-link:hover {
        background-color: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
    }
    /* Tombol Aktif (Halaman saat ini) - Mengikuti warna tema biru-ungu premium */
    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #4f46e5, #3b82f6) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25) !important;
    }
    /* Tombol ketika dinonaktifkan (Disabled) */
    .custom-pagination .page-item.disabled .page-link {
        background-color: #f8fafc !important;
        color: #cbd5e1 !important;
        border-color: #e2e8f0 !important;
        opacity: 0.6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('.btn-pemicu-hapus');
        
        tombolHapus.forEach(button => {
            button.addEventListener('click', function () {
                const formTerdekat = this.closest('.form-hapus-barang');
                
                Swal.fire({
                    title: 'Hapus barang ini?',
                    text: "Data produk ini akan dihapus permanen dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        formTerdekat.submit();
                    }
                });
            });
        });
    });
</script>
@endsection