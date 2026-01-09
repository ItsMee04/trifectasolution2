<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'nama',
        'kontak',
        'alamat',
        'image',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'pegawai_id', 'id');
    }
}
