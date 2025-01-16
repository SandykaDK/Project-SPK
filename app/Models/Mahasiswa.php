<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'kode_jurusan',
        'alamat',
        'id_periode',
    ];

    public function kriteria()
    {
        return $this->hasOne(Kriteria::class, 'nim', 'nim');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function ipk()
    {
        return $this->hasOne(Ipk::class, 'nim', 'nim');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'nim', 'nim');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode');
    }

    public function alternatif()
    {
        return $this->hasOne(Alternatif::class, 'nim', 'nim');
    }

    public function perhitungan()
    {
        return $this->hasMany(Perhitungan::class, 'nim', 'nim');
    }
}
