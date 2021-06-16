<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;
    protected $table = 'buys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_faktur',
        'judul',
        'jumlah_beli',
        'kasir',
    ];
}
