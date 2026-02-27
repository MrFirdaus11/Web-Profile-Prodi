<?php

/**
 * ADMIN PASSWORD RESET TOOL
 * 
 * Cara pakai:
 * 1. Buka URL: http://127.0.0.1:8000/reset-admin
 * 2. Password admin akan direset ke "admin123"
 * 3. HAPUS file ini setelah selesai (untuk keamanan)
 */

use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

Route::get('/reset-admin', function () {
    $admin = Admin::where('username', 'admin')->first();
    
    if ($admin) {
        $admin->password = Hash::make('admin123');
        $admin->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Password admin berhasil direset ke: admin123',
            'peringatan' => 'HAPUS file routes/reset-admin.php setelah selesai!'
        ]);
    }
    
    // Jika tidak ada admin, buat baru
    Admin::create([
        'username' => 'admin',
        'password' => Hash::make('admin123'),
        'nama_lengkap' => 'Administrator'
    ]);
    
    return response()->json([
        'success' => true,
        'message' => 'Admin baru berhasil dibuat dengan password: admin123',
        'peringatan' => 'HAPUS file routes/reset-admin.php setelah selesai!'
    ]);
});
