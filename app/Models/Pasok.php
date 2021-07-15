<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Distributor;
use App\Models\Book;

class Pasok extends Model
{
    use HasFactory;
    protected $fillable = [
        'buku_kode',
        'kode_distributor',
        'jumlah',
        'tanggal',
    ];

    public function distributor()
    {
        return $this->hasOne(Distributor::class,'kode_distributor','kode_distributor');
    }
    public function book()
    {
        return $this->hasOne(Book::class,'buku_kode','buku_kode');
    }
}