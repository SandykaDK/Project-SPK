<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ips extends Model
{
    use HasFactory;

    protected $table = 'ips';

    protected $primaryKey = 'id_siswa';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id_siswa',
        'b_inggris',
        'ekonomi',
        'sosiologi',
        'geografi',
        'sejarah',
    ];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
