<?php

namespace Tests\Feature;

use App\Models\Abstrak;
use App\Models\EmailLog;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\SertifikatKhusus;
use App\Models\User;
use App\Support\Verifikasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Regresi untuk bug yang sudah diperbaiki: penghapusan/penolakan abstrak yang sudah dibayar,
 * pembatalan email pengumuman, target pengumuman, peran & verifikasi sertifikat.
 */
class PerbaikanBugTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        Mail::fake();
    }

    private function user(string $role = 'peserta', array $atribut = []): User
    {
        return User::forceCreate($atribut + [
            'nama_lengkap' => 'Agus Triono', 'email' => fake()->unique()->safeEmail(), 'password' => Hash::make('rahasia123'),
            'role' => $role, 'nomor_handphone' => '081234567890', 'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Dosen', 'institusi' => 'UGM', 'provinsi' => 'DI Yogyakarta',
        ]);
    }

    private function abstrak(User $user, string $status = 'diterima'): Abstrak
    {
        return Abstrak::create([
            'user_id' => $user->id, 'judul_abstrak' => 'Judul ' . fake()->word(), 'file_abstrak_path' => 'abstrak/x.pdf',
            'file_abstrak_original_name' => 'x.pdf', 'status_abstrak' => $status,
        ]);
    }

    private function bayar(User $user, ?Abstrak $abstrak, string $status, string $kategori = 'umum_onsite'): Pembayaran
    {
        return Pembayaran::create([
            'user_id' => $user->id, 'abstrak_id' => $abstrak?->id, 'bukti_path' => 'bukti_pembayaran/x.png',
            'status' => $status, 'kategori_pembayaran' => $kategori, 'nominal' => 500000,
        ]);
    }

    public function test_abstrak_dengan_pembayaran_aktif_tidak_bisa_dihapus(): void
    {
        $peserta = $this->user();
        $abstrak = $this->abstrak($peserta, 'pending'); // mis. data lama yang dikaitkan ke abstrak belum diterima
        $this->bayar($peserta, $abstrak, 'pending');

        $this->actingAs($peserta)->delete(route('peserta.abstrak.delete', $abstrak))
            ->assertSessionHas('error');

        $this->assertModelExists($abstrak);
    }

    public function test_abstrak_tanpa_pembayaran_aktif_tetap_bisa_dihapus(): void
    {
        $peserta = $this->user();
        $abstrak = $this->abstrak($peserta, 'ditolak');
        $this->bayar($peserta, $abstrak, 'rejected');

        $this->actingAs($peserta)->delete(route('peserta.abstrak.delete', $abstrak))
            ->assertSessionHas('success');

        $this->assertModelMissing($abstrak);
    }

    public function test_admin_tidak_bisa_menolak_abstrak_yang_sudah_dibayar(): void
    {
        $peserta = $this->user();
        $abstrak = $this->abstrak($peserta);
        $this->bayar($peserta, $abstrak, 'verified');

        $this->actingAs($this->user('admin'))
            ->post(route('admin.abstracts.reject', $abstrak), ['catatan_reviewer_abstrak' => 'Tidak sesuai tema seminar.'])
            ->assertSessionHas('error');

        $this->assertSame('diterima', $abstrak->fresh()->status_abstrak);
    }

    public function test_hapus_pengumuman_membatalkan_email_yang_belum_terkirim(): void
    {
        $admin = $this->user('admin');
        foreach (range(1, 12) as $i) {
            $this->user(); // penerima
        }

        $this->actingAs($admin)->post(route('admin.pengumuman.store'), [
            'judul' => 'Link Zoom', 'isi' => 'Link salah', 'target' => 'semua', 'kirim_email' => '1',
        ])->assertRedirect(route('admin.pengumuman.index'));

        // 10 email pertama langsung dikirim (satu putaran), sisanya menunggu di antrean
        $pengumuman = Pengumuman::firstOrFail();
        $this->assertSame(12, EmailLog::where('pengumuman_id', $pengumuman->id)->count());
        $this->assertSame(10, EmailLog::where('pengumuman_id', $pengumuman->id)->where('status', 'terkirim')->count());
        $this->assertSame(2, EmailLog::where('pengumuman_id', $pengumuman->id)->where('status', 'antri')->count());

        $this->actingAs($admin)->delete(route('admin.pengumuman.destroy', $pengumuman))
            ->assertSessionHas('success', fn ($pesan) => str_contains($pesan, '2 email yang belum terkirim dibatalkan'));

        $this->assertSame(0, EmailLog::where('status', 'antri')->count());
        $this->assertSame(10, EmailLog::where('status', 'terkirim')->count()); // riwayat yang sudah terkirim tetap ada
        $this->assertModelMissing($pengumuman);
    }

    public function test_target_belum_bayar_tidak_termasuk_yang_menunggu_verifikasi(): void
    {
        $belumUpload = $this->user();
        $menunggu = $this->user();
        $this->bayar($menunggu, null, 'pending', 'non-presenter');
        $ditolak = $this->user();
        $this->bayar($ditolak, null, 'rejected', 'non-presenter');

        $ids = Pengumuman::queryPenerima('belum_bayar')->pluck('id')->all();

        $this->assertEqualsCanonicalizing([$belumUpload->id, $ditolak->id], $ids);
    }

    public function test_target_onsite_dan_online(): void
    {
        $onsite = $this->user();
        $this->bayar($onsite, $this->abstrak($onsite), 'verified', 'umum_onsite');
        $online = $this->user();
        $this->bayar($online, $this->abstrak($online), 'verified', 'mahasiswa_online');

        $this->assertSame([$onsite->id], Pengumuman::queryPenerima('onsite')->pluck('id')->all());
        $this->assertSame([$online->id], Pengumuman::queryPenerima('online')->pluck('id')->all());
    }

    public function test_sertifikat_peserta_peran_dari_sistem_dan_tombol_peran_tidak_ada(): void
    {
        config(['starnas.sertifikat_dibuka' => now()->subDay()->format('Y-m-d H:i')]);
        $peserta = $this->user();
        $this->bayar($peserta, $this->abstrak($peserta), 'verified');

        $html = $this->actingAs($peserta)->get(route('peserta.sertifikat.download'))->assertOk()->getContent();

        $this->assertStringContainsString('>Presenter<', $html);
        $this->assertStringNotContainsString("changeRole('Panitia'", $html);
        $this->assertStringContainsString('qr-verifikasi', $html);
    }

    public function test_sertifikat_terkunci_sebelum_acara(): void
    {
        config(['starnas.sertifikat_dibuka' => now()->addDay()->format('Y-m-d H:i')]);
        $peserta = $this->user();
        $this->bayar($peserta, null, 'verified', 'non-presenter');

        $this->actingAs($peserta)->get(route('peserta.sertifikat.download'))
            ->assertRedirect(route('peserta.riwayat'))->assertSessionHas('error');
    }

    public function test_verifikasi_qr_sertifikat_peserta_khusus_dan_kode_palsu(): void
    {
        $peserta = $this->user(atribut: ['nama_lengkap' => 'Siti Aminah']);
        $this->bayar($peserta, null, 'verified', 'non-presenter');
        $khusus = SertifikatKhusus::create(['nama' => 'Dr. Budi', 'peran' => 'Panitia']);

        $this->get(route('verifikasi', Verifikasi::kode('S', $peserta->id)))->assertOk()->assertSee('Siti Aminah');
        $this->get(route('verifikasi', Verifikasi::kode('K', $khusus->id)))->assertOk()->assertSee('Dr. Budi');
        $this->get(route('verifikasi', 'S-' . $peserta->id . '-000000000000'))->assertNotFound();
    }

    public function test_peserta_tidak_bisa_membuat_sertifikat_khusus(): void
    {
        $this->actingAs($this->user())
            ->post(route('admin.sertifikat.store'), ['peran' => 'Panitia', 'daftar' => 'Penyusup'])
            ->assertForbidden();

        $this->assertSame(0, SertifikatKhusus::count());
    }
}
