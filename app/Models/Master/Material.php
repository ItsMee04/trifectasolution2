<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'material';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'kode',
        'nama',
        'satuan',
        'rumus',
        'status',
    ];
}
