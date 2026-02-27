<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKelas;
use App\Models\Dosen;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileProdiController extends Controller
{
    // Main page with tabs
    public function index()
    {
        $programKelas = ProgramKelas::ordered()->get();
        $dosens = Dosen::ordered()->get();
        
        // Load Profil data
        $sambutan = Profil::getValue('sambutan', '');
        $kaprodi_nama = Profil::getValue('kaprodi_nama', 'Dr. Ahmad Fauzi, M.Kom');
        $kaprodi_jabatan = Profil::getValue('kaprodi_jabatan', 'Ketua Program Studi');
        $kaprodi_foto = Profil::getValue('kaprodi_foto', '');
        
        $visi = Profil::getValue('visi', '');
        $misi = Profil::getValue('misi', '');
        
        // Struktur organisasi - single image
        $struktur_image = Profil::getValue('struktur_image', '');
        
        return view('admin.profile-prodi.index', compact(
            'programKelas', 'dosens',
            'sambutan', 'kaprodi_nama', 'kaprodi_jabatan', 'kaprodi_foto',
            'visi', 'misi', 'struktur_image'
        ));
    }

    // ========== SAMBUTAN ==========

    public function updateSambutan(Request $request)
    {
        $request->validate([
            'sambutan' => 'required',
            'kaprodi_nama' => 'required|max:100',
            'kaprodi_jabatan' => 'required|max:100',
            'kaprodi_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        Profil::setValue('sambutan', $request->sambutan);
        Profil::setValue('kaprodi_nama', $request->kaprodi_nama);
        Profil::setValue('kaprodi_jabatan', $request->kaprodi_jabatan);

        if ($request->hasFile('kaprodi_foto')) {
            // Delete old photo
            $oldFoto = Profil::getValue('kaprodi_foto');
            if ($oldFoto && file_exists(public_path('assets/img/profil/' . $oldFoto))) {
                unlink(public_path('assets/img/profil/' . $oldFoto));
            }
            
            // Save new photo
            $foto = $request->file('kaprodi_foto');
            $filename = 'kaprodi_' . time() . '.' . $foto->getClientOriginalExtension();
            
            // Ensure directory exists
            $uploadPath = public_path('assets/img/profil');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $foto->move($uploadPath, $filename);
            Profil::setValue('kaprodi_foto', $filename);
        }

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Sambutan berhasil diupdate!');
    }

    // ========== VISI MISI ==========

    public function updateVisiMisi(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);

        Profil::setValue('visi', $request->visi);
        Profil::setValue('misi', $request->misi);

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Visi & Misi berhasil diupdate!');
    }

    // ========== STRUKTUR ==========

    public function updateStruktur(Request $request)
    {
        $request->validate([
            'struktur_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Max 5MB for org chart
        ]);

        // Handle image upload
        if ($request->hasFile('struktur_image')) {
            // Ensure upload directory exists
            $uploadPath = public_path('assets/img/struktur');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Delete old image
            $oldImage = Profil::getValue('struktur_image', '');
            if ($oldImage && file_exists($uploadPath . '/' . $oldImage)) {
                unlink($uploadPath . '/' . $oldImage);
            }
            
            // Save new image
            $image = $request->file('struktur_image');
            $filename = 'struktur_organisasi_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            Profil::setValue('struktur_image', $filename);
        }

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Struktur organisasi berhasil diupdate!');
    }

    // ========== PROGRAM KELAS ==========

    public function createProgram()
    {
        return view('admin.profile-prodi.program-create');
    }

    public function storeProgram(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'icon' => 'required|max:50',
            'deskripsi' => 'required',
            'jadwal' => 'required|max:200',
            'fitur' => 'nullable',
        ]);

        $fitur = array_filter(explode("\n", $request->fitur));
        
        ProgramKelas::create([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'deskripsi' => $request->deskripsi,
            'jadwal' => $request->jadwal,
            'fitur' => $fitur,
            'urutan' => ProgramKelas::max('urutan') + 1,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Program kelas berhasil ditambahkan!');
    }

    public function editProgram($id)
    {
        $program = ProgramKelas::findOrFail($id);
        return view('admin.profile-prodi.program-edit', compact('program'));
    }

    public function updateProgram(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'icon' => 'required|max:50',
            'deskripsi' => 'required',
            'jadwal' => 'required|max:200',
        ]);

        $program = ProgramKelas::findOrFail($id);
        $fitur = array_filter(explode("\n", $request->fitur));
        
        $program->update([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'deskripsi' => $request->deskripsi,
            'jadwal' => $request->jadwal,
            'fitur' => $fitur,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Program kelas berhasil diupdate!');
    }

    public function destroyProgram($id)
    {
        $program = ProgramKelas::findOrFail($id);
        $program->delete();

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Program kelas berhasil dihapus!');
    }

    // ========== DOSEN ==========

    public function createDosen()
    {
        return view('admin.profile-prodi.dosen-create');
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nidn' => 'nullable|max:20',
            'jabatan' => 'required|max:100',
            'bidang_keahlian' => 'nullable|max:200',
            'pendidikan' => 'nullable|max:100',
            'email' => 'nullable|email|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'nidn', 'jabatan', 'bidang_keahlian', 'pendidikan', 'email']);
        $data['urutan'] = Dosen::max('urutan') + 1;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('assets/img/dosen'), $filename);
            $data['foto'] = $filename;
        }

        Dosen::create($data);

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function editDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.profile-prodi.dosen-edit', compact('dosen'));
    }

    public function updateDosen(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nidn' => 'nullable|max:20',
            'jabatan' => 'required|max:100',
            'bidang_keahlian' => 'nullable|max:200',
            'pendidikan' => 'nullable|max:100',
            'email' => 'nullable|email|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dosen = Dosen::findOrFail($id);
        $data = $request->only(['nama', 'nidn', 'jabatan', 'bidang_keahlian', 'pendidikan', 'email']);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($dosen->foto && file_exists(public_path('assets/img/dosen/' . $dosen->foto))) {
                unlink(public_path('assets/img/dosen/' . $dosen->foto));
            }
            
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('assets/img/dosen'), $filename);
            $data['foto'] = $filename;
        }

        $dosen->update($data);

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Data dosen berhasil diupdate!');
    }

    public function destroyDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        
        // Delete photo
        if ($dosen->foto && file_exists(public_path('assets/img/dosen/' . $dosen->foto))) {
            unlink(public_path('assets/img/dosen/' . $dosen->foto));
        }
        
        $dosen->delete();

        return redirect()->route('admin.profile-prodi.index')
            ->with('success', 'Dosen berhasil dihapus!');
    }
}
