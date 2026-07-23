<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique();
            $table->foreignId('alat_id')->constrained('alat')->cascadeOnDelete();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('pengelola')->nullOnDelete();
            $table->integer('jumlah')->default(1);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', [
            'menunggu_konfirmasi',
            'disetujui',
            'ditolak',
            'dipinjam',
            'dikembalikan',
            'terlambat',
            'hilang',
            'rusak'
            ])->default('menunggu_konfirmasi');
            $table->decimal('denda', 12, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
