@extends('layouts.app')

@section('content')
<div class="card mx-auto shadow-sm" style="max-width: 500px;">
    <div class="card-header bg-warning text-dark"><h4>Edit Kategori</h4></div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection