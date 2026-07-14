@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/categoris/index.css') }}?v={{ time() }}">

<div class="mesh-gradient-bg"></div>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 85vh; padding: 2rem 0; position: relative; z-index: 2;">
    
    <div class="card-premium w-100" style="max-width: 850px; border-radius: 24px; background: #ffffff; padding: 2rem; box-shadow: 0 10px 35px rgba(15, 23, 42, 0.03); border: 1px solid #e2e8f0;">
        
        <div class="mb-4">
            <h3 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.75px;">Manajemen Kategori</h3>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 mb-4">
            <form action="{{ route('categories.index') }}" method="GET" class="flex-grow-1" style="max-width: 320px;">
                <div class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-premium py-2 px-3" style="font-size: 0.85rem;" placeholder="Cari nama kategori..." value="{{ request('search') }}" autocomplete="off">
                    <button type="submit" class="btn btn-premium-search px-3 fw-bold" style="font-size: 0.85rem;">Cari</button>
                </div>
            </form>

            <a href="{{ route('categories.create') }}" class="btn btn-premium-primary text-decoration-none px-4 py-2" style="font-size: 0.85rem;">
                + Tambah Kategori Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
                <thead class="table-light text-uppercase text-secondary" style="letter-spacing: 0.75px; font-size: 0.75rem; font-weight: 700;">
                    <tr>
                        <th class="py-3 px-4" style="border-radius: 12px 0 0 12px; width: 70%; background-color: #f8fafc;">Nama Kategori</th>
                        <th class="py-3 text-end px-4" style="border-radius: 0 12px 12px 0; width: 30%; background-color: #f8fafc;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr class="premium-row">
                        <td class="py-3 px-4">
                            <div class="d-flex align-items-center gap-2.5">
                                <span class="fw-semibold text-dark" style="font-size: 0.9rem;">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="text-end px-4 py-3">
                            <div class="d-flex justify-content-end gap-1.5">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-action-edit fw-bold">
                                    Edit
                                </a>
                                
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline form-hapus-kategori">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-action-delete fw-bold btn-pemicu-hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-5 text-muted small fw-medium" style="background-color: transparent;">
                            🔍 Belum ada data kategori yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($categories, 'links') && $categories->hasPages())
            <div class="mt-4 pt-2 border-top" style="border-color: #f1f5f9 !important;">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>

<script src="{{ asset('js/index.js') }}?v={{ time() }}"></script>
<link rel="stylesheet" href="{{ asset('css/categories/index.css') }}?v={{ time() }}">
@endsection