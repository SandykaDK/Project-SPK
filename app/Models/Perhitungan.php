<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;

    protected $table = 'perhitungan'; // Pastikan nama tabel sesuai dengan yang ada di database
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'id_periode', // Tambahkan id_periode ke fillable
        'normalisasi1',
        'normalisasi2',
        'normalisasi3',
        'normalisasi4',
        'normalisasi5',
        'preferensi1',
        'preferensi2',
        'preferensi3',
        'preferensi4',
        'preferensi5',
        'hasil',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode'); // Tambahkan relasi ke Periode
    }
}
