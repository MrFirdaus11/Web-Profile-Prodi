<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nidn', 20)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('bidang_keahlian', 200)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Insert sample data
        $dosens = [
            [
                'nama' => 'Dr. Ahmad Fauzi, M.Kom',
                'nidn' => '0123456789',
                'jabatan' => 'Ketua Program Studi',
                'bidang_keahlian' => 'Sistem Informasi, Data Mining',
                'pendidikan' => 'S3 Ilmu Komputer',
                'email' => 'ahmad.fauzi@unpari.ac.id',
                'urutan' => 1,
            ],
            [
                'nama' => 'Siti Rahma, M.Kom',
                'nidn' => '0123456790',
                'jabatan' => 'Sekretaris Prodi',
                'bidang_keahlian' => 'Basis Data, Web Development',
                'pendidikan' => 'S2 Teknik Informatika',
                'email' => 'siti.rahma@unpari.ac.id',
                'urutan' => 2,
            ],
            [
                'nama' => 'Budi Santoso, M.T.I',
                'nidn' => '0123456791',
                'jabatan' => 'Dosen Tetap',
                'bidang_keahlian' => 'Jaringan Komputer, Keamanan Sistem',
                'pendidikan' => 'S2 Teknologi Informasi',
                'email' => 'budi.santoso@unpari.ac.id',
                'urutan' => 3,
            ],
            [
                'nama' => 'Dewi Lestari, M.Kom',
                'nidn' => '0123456792',
                'jabatan' => 'Dosen Tetap',
                'bidang_keahlian' => 'Pemrograman Mobile, UI/UX Design',
                'pendidikan' => 'S2 Ilmu Komputer',
                'email' => 'dewi.lestari@unpari.ac.id',
                'urutan' => 4,
            ],
        ];

        foreach ($dosens as $dosen) {
            DB::table('dosens')->insert(array_merge($dosen, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
