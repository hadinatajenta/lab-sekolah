<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'role_name',
        'jumlah_user'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'role_id');
    }
}
