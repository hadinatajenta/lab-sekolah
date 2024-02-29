<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'jadwal_lab';
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

    public function lab():BelongsTo
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kelas():BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
