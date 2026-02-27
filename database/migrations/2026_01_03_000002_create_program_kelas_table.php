<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('icon', 50)->default('fa-graduation-cap');
            $table->text('deskripsi');
            $table->string('jadwal', 200);
            $table->text('fitur')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // Insert default data
        $programs = [
            [
                'nama' => 'Kelas Reguler Pagi',
                'icon' => 'fa-sun',
                'deskripsi' => 'Program kuliah reguler dengan jadwal pembelajaran di pagi hingga siang hari.',
                'jadwal' => 'Senin - Jumat (08.00 - 15.00)',
                'fitur' => json_encode(['Tatap muka langsung', 'Akses lab komputer', 'Kegiatan kemahasiswaan']),
                'urutan' => 1,
            ],
            [
                'nama' => 'Kelas Reguler Malam',
                'icon' => 'fa-moon',
                'deskripsi' => 'Program kuliah untuk mahasiswa yang bekerja atau memiliki aktivitas di pagi hari.',
                'jadwal' => 'Senin - Jumat (18.00 - 21.00)',
                'fitur' => json_encode(['Fleksibel untuk pekerja', 'Kurikulum sama', 'Fasilitas lengkap']),
                'urutan' => 2,
            ],
            [
                'nama' => 'Kelas Karyawan',
                'icon' => 'fa-briefcase',
                'deskripsi' => 'Program khusus untuk karyawan dengan jadwal yang lebih fleksibel.',
                'jadwal' => 'Sabtu & Minggu (08.00 - 16.00)',
                'fitur' => json_encode(['Blended learning', 'E-learning support', 'Mentoring online']),
                'urutan' => 3,
            ],
        ];

        foreach ($programs as $program) {
            DB::table('program_kelas')->insert(array_merge($program, [
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('program_kelas');
    }
};
