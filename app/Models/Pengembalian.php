<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'kode_pengembalian',
        'peminjaman_id',
        'diterima_oleh',
        'tanggal_kembali',
        'jumlah_dikembalikan',
        'kondisi_alat',
        'terlambat',
        'denda_terlambat',
        'denda_kerusakan',
        'total_denda',
        'status_denda',
        'catatan',
    ];

    protected $casts = [
        'tanggal_kembali' => 'date',
        'terlambat' => 'boolean',
        'denda_terlambat' => 'decimal:2',
        'denda_kerusakan' => 'decimal:2',
        'total_denda' => 'decimal:2',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function diterimaOleh()
    {
        return $this->belongsTo(Pengelola::class, 'diterima_oleh');
    }
}
