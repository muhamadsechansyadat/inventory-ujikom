<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKembali extends Model
{
    protected $table = 'detail_kembalis';
    protected $fillable = ['id_inventaris','id_peminjaman','baik','buruk'];
}
