@extends('layouts.app')

@section('content')
<div class="mesh-gradient-bg"></div>

<div class="card mx-auto shadow-sm" style="max-width: 500px; position: relative; z-index: 2;">
    <div class="card-header text-dark">
        <h4 class="m-0">Edit Kategori</h4>
    </div>
    
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label-premium">Nama Kategori</label>
                <input type="text" name="name" class="form-control-premium" value="{{ $category->name }}" required>
            </div>
            
            <button type="submit" class="btn-premium-primary">Perbarui</button>
            <a href="{{ route('categories.index') }}" class="btn-premium-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/categoris/edit.css') }}?v={{ time() }}">
@endpush