@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/items/index.css') }}?v={{ time() }}">

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-between align-items-center mb-4 position-relative" style="z-index: 2;">
    <div>
        <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -1px;">Kotak Sampah Barang</h2>
        <p class="text-muted small mb-0">Daftar produk yang dihapus sementara. Anda bisa mengembalikan data ini.</p>
    </div>
    <a href="{{ route('items.index') }}" class="btn btn-premium-primary text-decoration-none">
        Kembali ke Manajemen Barang
    </a>
</div>

<div class="card-premium position-relative" style="z-index: 2; border-radius: 24px; background: #ffffff; padding: 2rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
            <thead class="table-light text-uppercase fs-7 text-secondary" style="letter-spacing: 0.75px; font-size: 0.8rem;">
                <tr>
                    <th class="py-3 px-4" style="border-radius: 10px 0 0 10px;">Nama Barang</th>
                    <th class="py-3">Harga</th>
                    <th class="py-3 text-end px-4" style="border-radius: 0 10px 10px 0;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trashedItems as $item)
                <tr class="premium-row">
                    <td class="fw-bold py-3.5 px-4 text-dark">{{ $item->name }}</td>
                    <td class="text-muted fw-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-end px-4">
                        <form action="{{ route('items.restore', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-action-edit text-decoration-none border-0" style="background-color: #dcfce7 !important; color: #15803d !important;">
                                Kembalikan
                            </button>
                        </form>
                        
                        <form action="{{ route('items.force-delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete border-0">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted fw-medium">
                        🗑️ Kotak sampah kosong.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection