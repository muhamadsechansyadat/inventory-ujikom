<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Inventaris;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $fillable = ['nama','keterangan','jumlah','jumlah_baik','jumlah_buruk','id_jenis','id_ruang','kode_inventaris','id_petugas'];
}
