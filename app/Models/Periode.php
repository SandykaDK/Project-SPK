<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_periode',
        'tahun_periode',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_periode', 'id_periode');
    }

    public static function getYears()
    {
        return self::select('tahun_periode')->distinct()->orderBy('tahun_periode', 'asc')->get();
    }
}
