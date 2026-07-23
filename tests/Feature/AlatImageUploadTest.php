<?php

namespace Tests\Feature;

use App\Models\Alat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AlatImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_photo_is_saved_to_public_gambar_folder(): void
    {
        $photo = UploadedFile::fake()->create('tenda-test.jpg', 1, 'image/jpeg');

        $response = $this->post('/alat', [
            'nama_alat' => 'Tenda Test',
            'kategori' => 'Tenda',
            'deskripsi' => 'Uji upload foto',
            'jumlah' => 2,
            'kondisi' => 'baik',
            'status' => 'tersedia',
            'harga_sewa' => 50000,
            'tanggal_peminjaman' => null,
            'foto' => $photo,
            'catatan' => 'Test foto',
        ]);

        $response->assertStatus(302);

        $alat = Alat::first();
        $this->assertNotNull($alat);
        $this->assertNotEmpty($alat->foto);
        $this->assertFileExists(public_path('gambar/' . $alat->foto));
    }
}
