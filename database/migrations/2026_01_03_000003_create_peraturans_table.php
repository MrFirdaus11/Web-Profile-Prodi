<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peraturans', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->string('kategori', 50);
            $table->string('file', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peraturans');
    }
};
