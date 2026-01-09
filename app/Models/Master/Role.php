<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'role',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'role_id', 'id');
    }
}
