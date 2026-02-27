<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique();
            $table->longText('value');
            $table->timestamps();
        });

        // Insert default profile data
        $profiles = [
            ['key' => 'visi', 'value' => 'Menjadi Program Studi Sistem Informasi yang unggul dan kompetitif dalam menghasilkan lulusan yang profesional, inovatif, dan berkarakter di tingkat nasional.'],
            ['key' => 'misi', 'value' => "1. Menyelenggarakan pendidikan tinggi yang berkualitas di bidang sistem informasi.\n2. Melaksanakan penelitian yang inovatif dan bermanfaat bagi masyarakat.\n3. Melaksanakan pengabdian kepada masyarakat yang tepat sasaran.\n4. Membangun kerjasama dengan berbagai pihak untuk pengembangan institusi."],
            ['key' => 'sejarah', 'value' => 'Program Studi Sistem Informasi UNPARI didirikan untuk menjawab kebutuhan akan tenaga ahli di bidang teknologi informasi yang terus berkembang pesat.'],
            ['key' => 'alamat', 'value' => 'Jl. Jenderal A. Yani Lubuk Linggau, Sumatera Selatan'],
            ['key' => 'telepon', 'value' => '(0733) 123456'],
            ['key' => 'email', 'value' => 'si@unpari.ac.id'],
        ];

        foreach ($profiles as $profile) {
            DB::table('profils')->insert([
                'key' => $profile['key'],
                'value' => $profile['value'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
