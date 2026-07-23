<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';   // <-- baris ini WAJIB ada

    protected $fillable = [
        'nama_alat',
        'kategori',
        'deskripsi',
        'jumlah',
        'kondisi',
        'status',
        'harga_sewa',
        'tanggal_peminjaman',
        'foto',
        'catatan',
    ];

    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'harga_sewa' => 'decimal:2',
    ];
}
