<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SoftDeletes; // Mengaktifkan soft delete

    protected $fillable = ['name'];

    // Relasi: Satu kategori punya banyak barang (One to Many)
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}