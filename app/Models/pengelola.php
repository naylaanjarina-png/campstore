<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelola extends Model
{
    use HasFactory;

    protected $table = 'pengelola';

    protected $fillable = [
        'nama_pengelola',
        'no_hp',
        'email',
        'alamat',
        'bagian',
    ];

    public function peminjamanDisetujui()
    {
        return $this->hasMany(Peminjaman::class, 'disetujui_oleh');
    }

    public function pengembalianDiterima()
    {
        return $this->hasMany(Pengembalian::class, 'diterima_oleh');
    }
}
