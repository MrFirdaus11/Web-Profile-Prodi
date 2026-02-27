<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->string('url')->nullable()->after('nama_dokumen');
            $table->string('nama_file')->nullable()->change();
            $table->string('tipe_file')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->string('nama_file')->nullable(false)->change();
            $table->string('tipe_file')->nullable(false)->change();
        });
    }
};
