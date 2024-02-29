<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table ='jadwal_lab' ;
    protected $fillable = [
        'lab_id',
        'user_id',
        'kelas_id',
        'mata_pelajaran',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];
}
