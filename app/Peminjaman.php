<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['tanggal_kembali','tanggal_pinjam','status_peminjaman','id_petugas','id_pegawai'];
}
