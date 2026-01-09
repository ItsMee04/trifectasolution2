<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;
    protected $table = 'suplier';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'kode',
        'nama',
        'kontak',
        'alamat',
        'status',
    ];
}
