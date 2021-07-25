<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatans';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan','gaji_pokok','tunjangan_jabatan'];
}
