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
        <div class="col-md-5 d-flex gap-2 align-items-center">
            <input type="text" name="search" class="form-control form-control-premium" placeholder="Cari nama barang..." value="{{ request('search') }}" autocomplete="off">
            <button type="submit" class="btn btn-premium-primary px-4">Cari</button>
            
            <a href="{{ route('items.trash') }}" class="btn-premium-trash" title="Lihat Kotak Sampah">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg>
            </a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
           <thead class="table-light text-uppercase fs-7 text-secondary" style="letter-spacing: 0.75px; font-size: 0.8rem;">
    <tr>
        <th class="py-3 px-4" style="border-radius: 10px 0 0 10px;">Nama Barang / Kode</th>
        <th class="py-3">Kategori</th>
        <th class="py-3">Harga</th>
        <th class="py-3">Stok</th>
        <th class="py-3 text-end px-4" style="border-radius: 0 10px 10px 0;">Aksi</th>
    </tr>
</thead>
            <tbody>
                @forelse($items as $item)
                <tr class="premium-row">
<td class="py-3 px-4">
    <div class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $item->name }}</div>
    
    @if($item->code)
        <span class="text-muted font-monospace" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            {{ str_replace('BRG-', '', $item->code) }}
        </span>
    @else
        <span class="text-danger italic" style="font-size: 0.75rem;">Kode belum diset</span>
    @endif
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
<link rel="stylesheet" href="{{ asset('css/items/index.css') }}?v={{ time() }}">
@endsection
