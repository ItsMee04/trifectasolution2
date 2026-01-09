<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'kode',
        'kendaraan',
        'jenis',
        'nomor',
        'status',
    ];
}
