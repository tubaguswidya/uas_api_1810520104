<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = ['id_jabatan','id_golongan','nama_pegawai','status','jumlah_anak'];

    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
        
    }

    public function Golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_golongan');
        
    }

}
