<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_prestasi',
        'nim',
        'nama_prestasi',
        'tingkat_prestasi',
        'tahun_prestasi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}