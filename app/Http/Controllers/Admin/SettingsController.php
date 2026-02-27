<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Admin::find(session('admin_id'));
        return view('admin.settings.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Admin::find(session('admin_id'));
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username,' . $admin->id,
            'email' => 'nullable|email|max:100|unique:admins,email,' . $admin->id,
        ]);

        $admin->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Update session
        session(['admin_nama' => $request->nama_lengkap]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $admin = Admin::find(session('admin_id'));
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak benar.']);
        }

        // Update password
        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Password berhasil diperbarui!');
    }
}
