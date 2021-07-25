<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongans';
    protected $primaryKey = 'id_golongan';
    protected $fillable = ['tunjangan_nikah','tunjangan_anak','upah_makan','lembur','asuransi'];
}
