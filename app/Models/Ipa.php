<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipa extends Model
{
    use HasFactory;

    protected $table = 'ipa';

    protected $primaryKey = 'id_siswa';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id_siswa',
        'b_inggris',
        'matematika',
        'fisika',
        'kimia',
        'biologi',
    ];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
