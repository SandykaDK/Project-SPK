<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id_siswa',
        'nama',
        'jenis_kelamin',
        'jurusan',
        'alamat',
        'asal_sekolah',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function ipa()
    {
        return $this->hasOne(Ipa::class, 'id_siswa', 'id_siswa');
    }

    public function ips()
    {
        return $this->hasOne(Ips::class, 'id_siswa', 'id_siswa');
    }
}
