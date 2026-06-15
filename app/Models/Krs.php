<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'npm',
        'kode_matakuliah',
    ];

    /**
     * Get the mahasiswa for this KRS entry.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    /**
     * Get the mata kuliah for this KRS entry.
     */
    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}
