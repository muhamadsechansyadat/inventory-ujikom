<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPinjam extends Model
{
    protected $table = 'detail_pinjams';
    protected $fillable = ['id_inventaris','id_peminjaman','jumlah'];
}
