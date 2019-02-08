<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $fillable = [
        'nim',
        'keperluan'
    ];

    public function mahasiswa($value='')
    {
        return $this->hasOne(mahasiswa::class,'nim','nim');
    }
}
