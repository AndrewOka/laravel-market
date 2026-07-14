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
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush
@endsection