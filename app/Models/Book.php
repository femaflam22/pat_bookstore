<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_buku',
        'judul',
        'noisbn',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'harga_pokok',
        'harga_jual',
        'ppn',
        'diskon',
    ];
}
