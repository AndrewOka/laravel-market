@extends('layouts.app')

@section('content')
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

<style>
    .mesh-gradient-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: 
            radial-gradient(circle at 85% 15%, rgba(79, 70, 229, 0.4) 0%, transparent 55%), 
            radial-gradient(circle at 15% 85%, rgba(107, 33, 168, 0.35) 0%, transparent 55%);
        z-index: 1;
        pointer-events: none;
        background-color: #f8fafc;
    }

    .form-control-premium {
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px !important;
        color: #1e293b;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .form-control-premium:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1) !important;
        outline: none;
    }

    .btn-premium-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6) !important;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25) !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-premium-primary:hover {
        box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35) !important;
        transform: translateY(-1px);
    }

    .btn-premium-search {
        background-color: #4f46e5 !important;
        color: white !important;
        border: none;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    .btn-premium-search:hover {
        background-color: #4338ca !important;
    }

    .badge-folder-icon {
        background-color: #fffbeb;
        color: #d97706;
        padding: 0.35rem 0.5rem;
        border-radius: 8px;
        font-size: 0.85rem;
        border: 1px solid #fef3c7;
    }

    .premium-row {
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .premium-row:hover {
        background-color: #f8fafc !important;
    }
    .premium-row td {
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .btn-action-edit {
        background-color: #fffbeb !important;
        color: #d97706 !important;
        border: 1px solid #fef3c7 !important;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        transition: all 0.15s ease;
    }
    .btn-action-edit:hover {
        background-color: #fef3c7 !important;
        color: #b45309 !important;
    }

    .btn-action-delete {
        background-color: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1px solid #fee2e2 !important;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        transition: all 0.15s ease;
    }
    .btn-action-delete:hover {
        background-color: #fee2e2 !important;
        color: #b91c1c !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('.btn-pemicu-hapus');
        
        tombolHapus.forEach(button => {
            button.addEventListener('click', function () {
                const formTerdekat = this.closest('.form-hapus-kategori');
                
                Swal.fire({
                    title: 'Hapus kategori ini?',
                    text: "Menghapus kategori ini dapat memengaruhi data relasi barang yang memakai kelompok ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
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