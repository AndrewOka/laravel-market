<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Ambil data dengan pagination (5 data per halaman) + fitur pencarian
        $categories = Category::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // Memicu Soft Delete otomatis
        return redirect()->route('categories.index')->with('danger', 'Kategori berhasil dihapus (Soft Delete)!');
    }

    // 1. Menampilkan Halaman Trash Kategori
public function trash()
{
    $trashedCategories = Category::onlyTrashed()->get();
    return view('categories.trash', compact('trashedCategories'));
}

// 2. Mengembalikan Kategori
public function restore($id)
{
    $category = Category::withTrashed()->findOrFail($id);
    $category->restore();

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil diaktifkan kembali!');
}

// 3. Hapus Permanen Kategori
public function forceDelete($id)
{
    $category = Category::withTrashed()->findOrFail($id);
    $category->forceDelete();

    return redirect()->route('categories.trash')->with('success', 'Kategori telah dihapus permanen!');
}
}