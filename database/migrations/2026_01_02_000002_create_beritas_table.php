<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->string('slug', 255)->unique();
            $table->longText('isi_berita');
            $table->string('gambar', 100)->nullable();
            $table->date('tanggal');
            $table->enum('status', ['Published', 'Draft'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
