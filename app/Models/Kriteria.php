<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria'; // Ensure this matches the primary key column in the table
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_kriteria',
        'nama_kriteria',
        'bobot_kriteria',
        'tipe_kriteria',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function detailKriteria()
    {
        return $this->hasMany(DetailKriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
