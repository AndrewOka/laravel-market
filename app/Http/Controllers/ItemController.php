<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
 public function index(Request $request)
{
    // 1. Tangkap input pencarian sesuai atribut name di blade ('search')
    $search = $request->input('search'); 

    // 2. Buat query dasar
    $query = Item::query();

    // 3. Jika user mengetikkan sesuatu di kolom search
    if ($search) {
        $query->where('name', 'LIKE', "%{$search}%");
        // Catatan: Pastikan 'name' di atas sesuai dengan nama kolom 
        // nama barang di database kamu (di blade kamu tertulis $item->name)
    }

    // 4. Urutkan berdasarkan data terbaru (paling atas) dan pakai paginate
    $items = $query->latest()->paginate(5);

    // 5. Kirim data ke view
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
        
        return redirect()->route('items.index')->with('success', 'Barang berhasil dipindahkan ke kotak sampah!');
    }

    /* ========================================================
       METHOD TAMBAHAN KHUSUS SOFT DELETE (KOTAK SAMPAH)
       ======================================================== */

    // 1. Menampilkan Halaman List Barang Yang Dihapus Sementara
    public function trash()
    {
        $trashedItems = Item::onlyTrashed()->get();
        return view('items.trash', compact('trashedItems'));
    }

    // 2. Mengembalikan barang dari kotak sampah ke data aktif
    public function restore($id)
    {
        $item = Item::withTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dikembalikan!');
    }

    // 3. Menghapus barang secara permanen dari database
    public function forceDelete($id)
    {
        $item = Item::withTrashed()->findOrFail($id);
        $item->forceDelete();

        return redirect()->route('items.trash')->with('success', 'Barang telah dihapus secara permanen!');
    }
}