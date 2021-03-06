<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_faktur',
        'buku_kode',
        'kasir',
        'jumlah_beli',
        'bayar',
        'kembalian',
        'total_harga',
        'tanggal',
    ];

    public function getKasir()
    {
        return $this->hasOne(User::class, 'kode_user', 'kasir');
    }
    public function book()
    {
        return $this->hasOne(Book::class, 'buku_kode', 'buku_kode');
    }
}
