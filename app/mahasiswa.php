<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'nim',
        'nama',
        'alamat',
        'email',
        'no_telpon',
        'avatar',
        'last_login',
    ];
}
