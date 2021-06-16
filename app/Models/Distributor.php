<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasok;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_distributor',
        'alamat',
        'telpon',
    ];

    // public function pasok()
    // {
    //     return $this->belongsTo(Pasok::class);
    // }
}
