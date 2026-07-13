<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        // Relasi foreign key ke tabel categories
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
        $table->string('name');
        $table->integer('price');
        $table->integer('stock');
        $table->softDeletes(); // Mengaktifkan fitur Soft Delete
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
