<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'kode_matakuliah',
        'nidn',
        'kelas',
        'hari',
        'jam',
    ];

    protected $casts = [
        'jam' => 'datetime',
    ];

    /**
     * Get the mata kuliah for this jadwal.
     */
    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Get the dosen for this jadwal.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Get all KRS entries for this jadwal's mata kuliah.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}
