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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengembalian')->unique(); // no. transaksi, misal PGB-2026-0001
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->cascadeOnDelete();
            $table->foreignId('diterima_oleh')->nullable()->constrained('pengelola')->nullOnDelete();
            $table->date('tanggal_kembali');
            $table->integer('jumlah_dikembalikan')->default(1);
            $table->enum('kondisi_alat', ['baik', 'rusak_ringan', 'rusak_berat', 'hilang'])->default('baik');
            $table->boolean('terlambat')->default(false);
            $table->decimal('denda_terlambat', 12, 2)->default(0);
            $table->decimal('denda_kerusakan', 12, 2)->default(0);
            $table->decimal('total_denda', 12, 2)->default(0);
            $table->enum('status_denda', ['tidak_ada', 'belum_dibayar', 'lunas'])->default('tidak_ada');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
