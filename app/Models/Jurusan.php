<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'kode_jurusan';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kode_jurusan', 'kode_jurusan');
    }
}
