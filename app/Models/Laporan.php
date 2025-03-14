<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    /** @use HasFactory<\Database\Factories\LaporanFactory> */
    use HasFactory;
    protected $table = 'laporan';
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'pengaduan',
        'file_name',
        'jenis',
        'validasi'
    ];
}
