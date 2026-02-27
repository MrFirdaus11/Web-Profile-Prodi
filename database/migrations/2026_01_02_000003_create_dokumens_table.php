<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen', 100);
            $table->string('nama_file', 200);
            $table->enum('kategori', ['Akademik', 'Skripsi', 'Jadwal']);
            $table->string('tipe_file', 10);
            $table->date('tgl_upload');
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
