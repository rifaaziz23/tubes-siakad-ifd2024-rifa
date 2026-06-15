<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nidn',
        'nama',
        'user_id',
    ];

    /**
     * Get the user associated with this dosen.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get jadwal for this dosen.
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }

    /**
     * Get mahasiswa bimbingan.
     */
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }
}
