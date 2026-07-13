<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Ambil data barang beserta relasi kategorinya 
        $items = Item::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        // Ambil semua kategori untuk pilihan dropdown di form input barang
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ]);

        Item::create($request->all());
        
        return redirect()->route('items.index')->with('success', 'Barang baru berhasil ditambahkan!');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ]);

        $item->update($request->all());
        
        return redirect()->route('items.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete(); 
        
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus dari sistem!');
    }
}