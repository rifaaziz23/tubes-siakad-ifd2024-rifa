<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'npm',
        'nidn',
        'nama',
        'user_id',
    ];

    /**
     * Get the user associated with this mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the dosen pembimbing.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Get all KRS entries for this mahasiswa.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    /**
     * Get all mata kuliah through KRS.
     */
    public function matakuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'krs',
            'npm',
            'kode_matakuliah',
            'npm',
            'kode_matakuliah'
        );
    }
}
