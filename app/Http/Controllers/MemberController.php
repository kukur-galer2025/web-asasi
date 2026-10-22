<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // Jika pengunjung klik "JOIN US / Daftar Anggota", cek apakah sudah login
    public function redirectRegister()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.members')
                : redirect()->route('member.dashboard');
        }

        return redirect()->route('login')
            ->with('success', 'Silakan masuk dengan akun Google terlebih dahulu untuk mengajukan keanggotaan ASASI.');
    }

    // Menampilkan Dashboard Mandiri Member & Form Pengajuan KTA
    public function dashboard()
    {
        $user = Auth::user();
        $member = MemberProfile::where('user_id', $user->id)->first();

        return view('frontend.member-dashboard', compact('user', 'member'));
    }

    // Menyimpan Pengajuan Baru atau Update Biodata Member
    public function saveProfile(Request $request)
    {
        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'nik'             => 'nullable|string|max:20',
            'instansi'        => 'required|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
            'wilayah_dpw'     => 'nullable|string|max:100',
            'no_whatsapp'     => 'required|string|max:20',
            'foto_profil'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'foto_profil.image' => 'File pas foto harus berupa gambar.',
            'foto_profil.mimes' => 'Format pas foto harus JPG, JPEG, atau PNG.',
            'foto_profil.max'   => 'Ukuran pas foto maksimal 2MB.',
        ]);

        $user = Auth::user();
        $existing = MemberProfile::where('user_id', $user->id)->first();

        $data = [
            'nama_lengkap'    => $request->nama_lengkap,
            'nik'             => $request->nik,
            'instansi'        => $request->instansi,
            'bidang_keahlian' => $request->bidang_keahlian,
            'wilayah_dpw'     => $request->wilayah_dpw,
            'no_whatsapp'     => $request->no_whatsapp,
            'status'          => $existing ? $existing->status : 'pending',
        ];

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($existing && $existing->foto_profil && Storage::disk('public')->exists($existing->foto_profil)) {
                Storage::disk('public')->delete($existing->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('member-photos', 'public');
        }

        MemberProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        $pesan = $existing
            ? 'Biodata dan pas foto keanggotaan Anda berhasil diperbarui.'
            : 'Pengajuan keanggotaan beserta pas foto berhasil dikirim! Menunggu verifikasi Admin.';

        return redirect()->route('member.dashboard')->with('success', $pesan);
    }

    // Unduh KTA PDF oleh Anggota Sendiri
    public function cetakKta()
    {
        $member = MemberProfile::where('user_id', Auth::id())->firstOrFail();

        if ($member->status !== 'active') {
            return redirect()->route('member.dashboard')
                ->with('success', 'KTA hanya dapat diunduh setelah pengajuan Anda diverifikasi oleh Admin.');
        }

        // Gunakan ukuran ID Card dalam posisi portrait lalu dibalik oleh parameter 'landscape'
       $pdf = Pdf::loadView('pdf.kta', compact('member'))
                  ->setPaper([0, 0, 325, 204], 'portrait');

        return $pdf->stream("KTA-{$member->nomor_anggota}.pdf");
    }
}