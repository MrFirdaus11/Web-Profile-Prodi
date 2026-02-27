<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bagan_kurikulums', function (Blueprint $table) {
            $table->id();
            $table->string('angkatan'); // e.g., "2019", "2021 s.d 2022"
            $table->string('link_bagan')->nullable();
            $table->string('link_matkul')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagan_kurikulums');
    }
};
