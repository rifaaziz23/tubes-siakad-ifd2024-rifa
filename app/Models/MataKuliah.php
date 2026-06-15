<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
    ];

    /**
     * Get all jadwal for this mata kuliah.
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Get all KRS entries referencing this mata kuliah.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
     * Get mahasiswa who have taken this mata kuliah.
     */
    public function mahasiswa()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            'krs',
            'kode_matakuliah',
            'npm',
            'kode_matakuliah',
            'npm'
        );
    }
}
