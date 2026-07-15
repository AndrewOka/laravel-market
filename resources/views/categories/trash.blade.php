@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/categoris/index.css') }}?v={{ time() }}">

<div class="mesh-gradient-bg"></div>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 85vh; padding: 2rem 0; position: relative; z-index: 2;">

    <div class="card-premium w-100" style="max-width: 850px; border-radius: 24px; background: #ffffff; padding: 2rem; box-shadow: 0 10px 35px rgba(15, 23, 42, 0.03); border: 1px solid #e2e8f0;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.75px;">Kotak Sampah Kategori</h3>
                <p class="text-muted small mb-0">Daftar kelompok kategori yang dihapus sementara.</p>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-premium-primary text-decoration-none px-4 py-2" style="font-size: 0.85rem;">
                Kembali
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
                <thead class="table-light text-uppercase text-secondary" style="letter-spacing: 0.75px; font-size: 0.75rem; font-weight: 700;">
                    <tr>
                        <th class="py-3 px-4" style="border-radius: 12px 0 0 12px; width: 65%; background-color: #f8fafc;">Nama Kategori</th>
                        <th class="py-3 text-end px-4" style="border-radius: 0 12px 12px 0; width: 35%; background-color: #f8fafc;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trashedCategories as $category)
                    <tr class="premium-row">
                        <td class="py-3 px-4">
                            <span class="fw-semibold text-dark" style="font-size: 0.9rem;">{{ $category->name }}</span>
                        </td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex justify-content-end gap-1.5">
                                <form action="{{ route('categories.restore', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-action-edit fw-bold border-0" style="background-color: #dcfce7 !important; color: #15803d !important;">
                                        Kembalikan
                                    </button>
                                </form>

                                <form action="{{ route('categories.force-delete', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Peringatan! Menghapus kategori ini secara permanen akan memutus relasi data barang di dalamnya. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action-delete fw-bold border-0">
                                        Hapus Permanen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-5 text-muted small fw-medium" style="background-color: transparent;">
                            🗑️ Kotak sampah kategori kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection