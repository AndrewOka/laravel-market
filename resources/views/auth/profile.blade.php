@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 80vh; z-index: 2;">
    <div class="card-premium w-100" style="max-width: 550px; border-radius: 24px; background: #ffffff; padding: 2.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
        
        <div class="text-center mb-4">
            <div class="avatar-wrapper mx-auto mb-3">
                <span class="avatar-initial">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </span>
                <div class="avatar-online-badge"></div>
            </div>
            <h3 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">Profil Pengguna</h3>
            <p class="text-muted small mt-1 mb-0">Informasi kredensial dan hak akses akun Anda</p>
            <hr class="mx-auto my-3" style="width: 60px; height: 3px; background-color: #4f46e5; border: none; border-radius: 10px;">
        </div>

        <div class="profile-details-container d-flex flex-column gap-3 mb-4">
            <div class="profile-field-row">
                <span class="field-label">Nama Lengkap</span>
                <span class="field-value text-dark fw-bold text-capitalize">
                    {{ $user->name ?? 'Nama Belum Diatur' }}
                </span>
            </div>
            
            <div class="profile-field-row">
                <span class="field-label">Alamat Email</span>
                <span class="field-value text-secondary fw-semibold">
                    {{ $user->email ?? 'Email Belum Diatur' }}
                </span>
            </div>

            <div class="profile-field-row">
                <span class="field-label">No. Telepon</span>
                <span class="field-value text-muted">
                    {{ $user->phone ?? '-' }}
                </span>
            </div>

            <div class="profile-field-row">
                <span class="field-label">Bergabung Sejak</span>
                <span class="field-value text-muted small">
                    {{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '-' }}
                </span>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('items.index') }}" class="btn btn-premium-primary px-4 py-2.5 fw-bold w-100" style="border-radius: 12px; font-size: 0.95rem;">
                Kembali ke Dashboard
            </a>
        </div>

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

    /* Desain Lingkaran Foto Profil Modern dengan Inisial */
    .avatar-wrapper {
        position: relative;
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #e0e7ff, #f3e8ff);
        border: 3px solid #ffffff;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-initial {
        font-size: 2.25rem;
        font-weight: 800;
        background: linear-gradient(135deg, #4f46e5, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .avatar-online-badge {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 14px;
        height: 14px;
        background-color: #10b981;
        border: 2.5px solid #ffffff;
        border-radius: 50%;
    }

    /* Struktur List Informasi Baris */
    .profile-details-container {
        background-color: #f8fafc;
        padding: 1.25rem;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
    }
    .profile-field-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 1px dashed #e2e8f0;
    }
    .profile-field-row:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }
    .field-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
    }
    .field-value {
        font-size: 0.95rem;
    }

    /* Tombol Premium Primary */
    .btn-premium-primary {
        background: linear-gradient(135deg, #4f46e5, #3b82f6) !important;
        color: white !important;
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