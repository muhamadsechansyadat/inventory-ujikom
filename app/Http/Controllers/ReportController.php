<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Inventaris;
use App\Ruang;

class ReportController extends Controller
{
	public function peminjaman(){
	    $datapeminjaman = DB::table('peminjaman')
	    				->join('detail_pinjams', 'detail_pinjams.id_peminjaman', '=', 'peminjaman.id')
	    				->join('inventaris', 'inventaris.id', '=', 'detail_pinjams.id_inventaris')
	    				->join('pegawais', 'pegawais.id', '=', 'peminjaman.id_pegawai')
	    				->select('peminjaman.id','inventaris.nama as nama_inventaris','detail_pinjams.id_inventaris','peminjaman.tanggal_pinjam','peminjaman.tanggal_kembali','detail_pinjams.jumlah','pegawais.nama_pegawai')
	    				->get();
	    // dd($data)				            		
	    return view('report.reportpeminjaman', compact('datapeminjaman'));
    }

    public function pengembalian(){
    	$datapengembalian = DB::table('detail_kembalis')
    					->join('inventaris', 'inventaris.id', '=', 'detail_kembalis.id_inventaris')
    					->join('peminjaman', 'peminjaman.id', '=', 'detail_kembalis.id_peminjaman')
    					->select('detail_kembalis.*','inventaris.nama','peminjaman.id_pegawai')
    					->get();
    	return view('report.reportpengembalian', compact('datapengembalian'));				
	}
	
	public function ruang(){
		$data = Inventaris::get();
		$data1 = Ruang::get();
		return view('report.reportruang', compact('data','data1'));
	}

	public function perruang($id){
		$data = Ruang::where('id',$id)->first();
		// dd($data);
		$data1 = Inventaris::where('id_ruang', $data['id'])->get();
		// dd($data1);
		return view('report.perruang', compact('data1'));
	}
}
