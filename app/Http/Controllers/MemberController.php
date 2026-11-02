<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use App\Models\MembershipPayment;
use App\Notifications\AdminNewPayment;
use App\Notifications\PaymentSubmitted;
use App\Support\Notifier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        $member = MemberProfile::with(['payments', 'pendingPayment'])->where('user_id', $user->id)->first();

        return view('frontend.member-dashboard', compact('user', 'member'));
    }

    // Menyimpan Pengajuan Baru atau Update Biodata Member
    public function saveProfile(Request $request)
    {
        $user = Auth::user();
        $existing = MemberProfile::where('user_id', $user->id)->first();

        // Pengajuan pertama wajib menyertakan durasi & bukti pembayaran pendaftaran
        $paymentRules = $existing ? [] : $this->paymentRules();

        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'nik'             => 'nullable|string|max:20',
            'instansi'        => 'required|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
            'wilayah_dpw'     => 'nullable|string|max:100',
            'no_whatsapp'     => 'required|string|max:20',
            'foto_profil'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ] + $paymentRules, [
            'foto_profil.image' => 'File pas foto harus berupa gambar.',
            'foto_profil.mimes' => 'Format pas foto harus JPG, JPEG, atau PNG.',
            'foto_profil.max'   => 'Ukuran pas foto maksimal 2MB.',
        ] + $this->paymentMessages());

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

        $buktiPath = $existing ? null : $this->storeBukti($request->file('bukti_pembayaran'));

        try {
            $payment = DB::transaction(function () use ($user, $data, $existing, $request, $buktiPath) {
                $member = MemberProfile::updateOrCreate(['user_id' => $user->id], $data);

                return $existing
                    ? null
                    : $this->createPayment($member, MembershipPayment::JENIS_PENDAFTARAN, (int) $request->durasi_tahun, $buktiPath, $request->file('bukti_pembayaran'));
            });
        } catch (\Throwable $e) {
            if ($buktiPath) {
                Storage::disk('local')->delete($buktiPath);
            }
            throw $e;
        }

        if ($payment) {
            $this->notifyPaymentSubmitted($payment);
        }

        $pesan = $existing
            ? 'Biodata dan pas foto keanggotaan Anda berhasil diperbarui.'
            : 'Pengajuan keanggotaan beserta bukti pembayaran berhasil dikirim! Konfirmasi telah dikirim ke email Anda (periksa juga folder Spam).';

        return redirect()->route('member.dashboard')->with('success', $pesan);
    }

    // Ajukan pembayaran: perpanjangan, atau unggah ulang bukti pendaftaran yang ditolak
    public function storePayment(Request $request)
    {
        $member = MemberProfile::where('user_id', Auth::id())->firstOrFail();

        if ($alasan = $member->alasanTidakBisaBayar()) {
            return redirect()->route('member.dashboard')->withErrors(['pembayaran' => $alasan]);
        }

        $request->validate($this->paymentRules(), $this->paymentMessages());

        $jenis = $member->jenisPembayaranBerikutnya();
        $buktiPath = $this->storeBukti($request->file('bukti_pembayaran'));

        try {
            $payment = $this->createPayment($member, $jenis, (int) $request->durasi_tahun, $buktiPath, $request->file('bukti_pembayaran'));
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($buktiPath);
            throw $e;
        }

        $this->notifyPaymentSubmitted($payment);

        $label = $jenis === MembershipPayment::JENIS_PENDAFTARAN ? 'pendaftaran' : 'perpanjangan';

        return redirect()->route('member.dashboard')
            ->with('success', "Bukti pembayaran {$label} berhasil dikirim. Pengurus akan memverifikasi dalam waktu dekat. Pantau lonceng notifikasi & email Anda (periksa juga folder Spam).");
    }

    private function notifyPaymentSubmitted(MembershipPayment $payment): void
    {
        $payment->loadMissing('member.user');
        Notifier::send($payment->member->user, new PaymentSubmitted($payment));
        Notifier::admins(new AdminNewPayment($payment));
    }

    // Tampilkan file bukti pembayaran (disk privat), hanya untuk pemilik & admin
    public function buktiPembayaran(MembershipPayment $payment)
    {
        Gate::authorize('view', $payment);

        abort_unless(Storage::disk('local')->exists($payment->bukti_path), 404);

        return Storage::disk('local')->response($payment->bukti_path, $payment->bukti_nama_asli);
    }

    private function paymentRules(): array
    {
        return [
            'durasi_tahun'     => ['required', 'integer', Rule::in(MembershipPayment::DURASI)],
            'bukti_pembayaran' => ['required', 'file', 'mimes:' . config('asasi.bukti.mimes'), 'max:' . config('asasi.bukti.max_kb')],
        ];
    }

    private function paymentMessages(): array
    {
        return [
            'durasi_tahun.required'     => 'Pilih masa keanggotaan (1 atau 2 tahun).',
            'durasi_tahun.in'           => 'Masa keanggotaan hanya dapat 1 atau 2 tahun.',
            'bukti_pembayaran.required' => 'Unggah bukti pembayaran (transfer) terlebih dahulu.',
            'bukti_pembayaran.mimes'    => 'Bukti pembayaran harus berupa JPG, PNG, WEBP, atau PDF.',
            'bukti_pembayaran.max'      => 'Ukuran bukti pembayaran maksimal ' . (config('asasi.bukti.max_kb') / 1024) . 'MB.',
        ];
    }

    private function storeBukti(UploadedFile $file): string
    {
        return $file->store('payment-proofs/' . date('Y/m'), 'local');
    }

    private function createPayment(MemberProfile $member, string $jenis, int $durasi, string $buktiPath, UploadedFile $file): MembershipPayment
    {
        return $member->payments()->create([
            'jenis'           => $jenis,
            'durasi_tahun'    => $durasi,
            'nominal'         => MembershipPayment::nominalFor($jenis, $durasi),
            'bukti_path'      => $buktiPath,
            'bukti_nama_asli' => mb_substr($file->getClientOriginalName(), 0, 200),
            'status'          => MembershipPayment::STATUS_PENDING,
        ]);
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