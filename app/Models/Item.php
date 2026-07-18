<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use SoftDeletes; // Mengaktifkan soft delete

    protected $fillable = ['code', 'name', 'category_id', 'price', 'stock'];

    // Relasi: Barang ini milik sebuah kategori (Belongs To)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}