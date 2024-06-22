<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $fillable = ['nama_jurusan', 'fakultas_id'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class,'fakultas_id','id');
    }
    public function anggota()
    {
        return $this->hasMany(Anggota::class,'id_jurusan','id');
    }
}
