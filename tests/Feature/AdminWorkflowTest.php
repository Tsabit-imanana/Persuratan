<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use App\Models\SuratPengantarKelurahan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected KetuaRt $ketuaRt;

    protected function setUp(): void
    {
        parent::setUp();

        // Create standard admin user
        $this->admin = User::factory()->create([
            'email' => 'admin@desa.com',
            'password' => bcrypt('password'),
        ]);

        // Create standard Ketua RT
        $this->ketuaRt = KetuaRt::create([
            'nama' => 'INDAH SYAHFRIYANTI',
            'nik' => '3522156608760007',
            'rt' => '003',
            'rw' => '001',
            'no_whatsapp' => '6281359465946',
        ]);
    }

    /**
     * Test guest is redirected to login page.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    /**
     * Test admin can login successfully.
     */
    public function test_admin_can_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@desa.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    /**
     * Test admin can create a new Ketua RT.
     */
    public function test_admin_can_create_ketua_rt(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/ketua-rt', [
            'nama' => 'BUDI UTOMO',
            'nik' => '3522151706720004',
            'rt' => '007',
            'rw' => '001',
            'no_whatsapp' => '62895395389863',
        ]);

        $response->assertRedirect('/ketua-rt');
        $this->assertDatabaseHas('ketua_rt', [
            'nik' => '3522151706720004',
            'nama' => 'BUDI UTOMO',
        ]);
    }

    /**
     * Test admin can submit a new Surat Pengantar RT.
     */
    public function test_admin_can_create_surat_pengantar_rt(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/surat-rt', [
            'rt_id' => $this->ketuaRt->id,
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Bojonegoro',
            'tanggal_lahir' => '1995-05-12',
            'nik' => '3522151205950001',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Merpati No. 10',
            'keperluan' => 'Pembuatan KTP Baru',
        ]);

        $response->assertRedirect('/surat-rt');
        $this->assertDatabaseHas('surat_pengantar_rt', [
            'nik' => '3522151205950001',
            'nama' => 'Budi Santoso',
            'status' => 'pending',
        ]);
    }

    /**
     * Test Fonnte Webhook updates Surat Pengantar RT status.
     */
    public function test_fonnte_webhook_updates_status(): void
    {
        // 1. Create a pending letter
        $surat = SuratPengantarRt::create([
            'rt_id' => $this->ketuaRt->id,
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Bojonegoro',
            'tanggal_lahir' => '1995-05-12',
            'nik' => '3522151205950001',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Merpati No. 10',
            'keperluan' => 'Pembuatan KTP Baru',
            'status' => 'pending',
        ]);

        // 2. Simulate Ketua RT sending "ACC 1 Catatan Penyetujuan"
        $response = $this->postJson('/api/fonnte/webhook', [
            'sender' => $this->ketuaRt->no_whatsapp,
            'message' => "ACC {$surat->id} Berkas lengkap dan sah",
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
        ]);

        $this->assertDatabaseHas('surat_pengantar_rt', [
            'id' => $surat->id,
            'status' => 'disetujui',
            'catatan' => 'Berkas lengkap dan sah',
        ]);
    }

    /**
     * Test admin can download approved Surat Pengantar RT PDF.
     */
    public function test_admin_can_download_approved_surat_pengantar_rt_pdf(): void
    {
        $this->actingAs($this->admin);

        $surat = SuratPengantarRt::create([
            'rt_id' => $this->ketuaRt->id,
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Bojonegoro',
            'tanggal_lahir' => '1995-05-12',
            'nik' => '3522151205950001',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Merpati No. 10',
            'keperluan' => 'Pembuatan KTP Baru',
            'status' => 'disetujui',
        ]);

        $response = $this->get(route('surat-rt.download-pdf', $surat->id));
        
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    /**
     * Test admin cannot download pending Surat Pengantar RT PDF.
     */
    public function test_admin_cannot_download_pending_surat_pengantar_rt_pdf(): void
    {
        $this->actingAs($this->admin);

        $surat = SuratPengantarRt::create([
            'rt_id' => $this->ketuaRt->id,
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Bojonegoro',
            'tanggal_lahir' => '1995-05-12',
            'nik' => '3522151205950001',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Merpati No. 10',
            'keperluan' => 'Pembuatan KTP Baru',
            'status' => 'pending',
        ]);

        $response = $this->get(route('surat-rt.download-pdf', $surat->id));
        
        $response->assertStatus(403);
    }
}
