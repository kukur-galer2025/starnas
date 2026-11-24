<?php

namespace Tests\Feature;

use App\Models\Abstrak;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PembayaranPerAbstrakTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    private function peserta(array $atribut = []): User
    {
        return User::forceCreate($atribut + [
            'nama_lengkap' => 'Agus Triono', 'email' => fake()->unique()->safeEmail(), 'password' => Hash::make('rahasia123'),
            'role' => 'peserta', 'nomor_handphone' => '081234567890', 'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Dosen', 'institusi' => 'UGM', 'provinsi' => 'DI Yogyakarta',
        ]);
    }

    private function abstrak(User $user, string $judul, string $status = 'diterima'): Abstrak
    {
        return Abstrak::create([
            'user_id' => $user->id, 'judul_abstrak' => $judul, 'file_abstrak_path' => 'abstrak/x.pdf',
            'file_abstrak_original_name' => 'x.pdf', 'status_abstrak' => $status,
        ]);
    }

    private function bayar(User $user, ?Abstrak $abstrak, string $kategori = 'umum_onsite')
    {
        return $this->actingAs($user)->post(route('peserta.pembayaran.store'), array_filter([
            'kategori_pembayaran' => $kategori,
            'abstrak_id' => $abstrak?->id,
            'nomor_anggota_asasi' => str_starts_with($kategori, 'asasi') ? '45451-2026-0001' : null,
            'bukti_bayar' => UploadedFile::fake()->image('bukti.jpg'),
        ]));
    }

    public function test_peserta_dengan_tiga_abstrak_dapat_membayar_ketiganya(): void
    {
        $user = $this->peserta();
        [$a1, $a2, $a3] = [$this->abstrak($user, 'Abstrak Satu'), $this->abstrak($user, 'Abstrak Dua'), $this->abstrak($user, 'Abstrak Tiga')];

        $this->bayar($user, $a1)->assertRedirect(route('peserta.riwayat'))->assertSessionHas('success');
        Pembayaran::where('abstrak_id', $a1->id)->update(['status' => 'verified']);

        // Kasus yang dilaporkan: setelah pembayaran pertama terverifikasi, abstrak ke-2 & ke-3 tetap bisa dibayar
        $this->actingAs($user)->get(route('peserta.pembayaran.upload', ['abstrak' => $a2->id]))
            ->assertOk()
            ->assertSee('id="form-bukti"', false)
            ->assertSee('Pembayaran per Abstrak')
            ->assertSee('<option value="' . $a2->id . '" selected', false)
            ->assertDontSee('Anda tidak perlu mengunggah bukti pembayaran lagi');

        $this->bayar($user, $a2, 'asasi_online')->assertSessionHas('success');
        $this->bayar($user, $a3, 'mahasiswa_online')->assertSessionHas('success');

        $this->assertSame(3, Pembayaran::where('user_id', $user->id)->count());
        $this->assertEqualsCanonicalizing([$a1->id, $a2->id, $a3->id], Pembayaran::pluck('abstrak_id')->all());
        $this->assertSame(150000, (int) Pembayaran::where('abstrak_id', $a3->id)->value('nominal'));

        // Semua sudah dibayar: form tidak tampil lagi
        $this->actingAs($user)->get(route('peserta.pembayaran.upload'))
            ->assertOk()->assertDontSee('id="form-bukti"', false)->assertSee('Semua pembayaran Anda sudah diunggah');
    }

    public function test_satu_abstrak_tidak_dapat_dibayar_dua_kali(): void
    {
        $user = $this->peserta();
        $a1 = $this->abstrak($user, 'Abstrak Satu');

        $this->bayar($user, $a1);
        $this->bayar($user, $a1)->assertRedirect(route('peserta.riwayat'))->assertSessionHas('error');

        $this->assertSame(1, Pembayaran::count());
    }

    public function test_abstrak_yang_belum_diterima_atau_milik_orang_lain_ditolak(): void
    {
        $user = $this->peserta();
        $lain = $this->peserta();
        $belumDiterima = $this->abstrak($user, 'Masih Direview', 'pending');
        $milikLain = $this->abstrak($lain, 'Punya Orang Lain');

        $this->bayar($user, $belumDiterima)->assertRedirect(route('peserta.abstrak.upload'))->assertSessionHas('error');
        $this->bayar($user, $milikLain)->assertSessionHas('error');

        $this->assertSame(0, Pembayaran::count());
        Storage::disk('public')->assertDirectoryEmpty('bukti_pembayaran');
    }

    public function test_upload_ulang_setelah_ditolak_memakai_baris_yang_sama(): void
    {
        $user = $this->peserta();
        $a1 = $this->abstrak($user, 'Abstrak Satu');

        $this->bayar($user, $a1);
        $lama = Pembayaran::first();
        $lama->update(['status' => 'rejected', 'catatan_admin' => 'Nominal kurang']);

        $this->actingAs($user)->get(route('peserta.pembayaran.upload', ['abstrak' => $a1->id]))
            ->assertSee('Bukti Sebelumnya Ditolak')->assertSee('Nominal kurang');

        $this->bayar($user, $a1)->assertSessionHas('success');

        $this->assertSame(1, Pembayaran::count());
        $this->assertSame('pending', $lama->fresh()->status);
        Storage::disk('public')->assertMissing($lama->bukti_path);
    }

    public function test_non_presenter_hanya_jika_belum_ada_pembayaran_aktif(): void
    {
        $user = $this->peserta();
        $this->bayar($user, null, 'non-presenter')->assertSessionHas('success');
        $this->assertNull(Pembayaran::first()->abstrak_id);

        $this->bayar($user, null, 'non-presenter')->assertSessionHas('error');
        $this->assertSame(1, Pembayaran::count());
    }

    public function test_kategori_pemakalah_wajib_memilih_abstrak(): void
    {
        $user = $this->peserta();
        $this->abstrak($user, 'Abstrak Satu');

        $this->actingAs($user)->post(route('peserta.pembayaran.store'), [
            'kategori_pembayaran' => 'umum_onsite',
            'bukti_bayar' => UploadedFile::fake()->image('bukti.jpg'),
        ])->assertSessionHasErrors('abstrak_id');
    }

    public function test_email_abstrak_diterima_mengarah_ke_pembayaran_abstrak_tersebut(): void
    {
        $admin = $this->peserta(['role' => 'admin']);
        $user = $this->peserta();
        $abstrak = $this->abstrak($user, 'Abstrak Kedua', 'pending');

        $this->actingAs($admin)->post(route('admin.abstracts.verify', $abstrak), ['catatan_reviewer_abstrak' => 'Bagus']);

        $notif = Notifikasi::where('user_id', $user->id)->latest('id')->first();
        $this->assertStringContainsString('abstrak=' . $abstrak->id, (string) $notif->url);
    }
}
