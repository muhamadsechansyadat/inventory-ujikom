<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventaris;
use App\Jenis;
use App\Ruang;
use DB;

class InventarisController extends Controller
{
    public function index(){
		$data = DB::table('inventaris')
					->join('ruangs', 'ruangs.id', '=', 'inventaris.id_ruang')
					->select('inventaris.*','ruangs.kode_ruang')
					->orderBy('id','desc')
					->get();
    	// dd($data,$ruang);
    	return view('inven.index', compact('data','ruang'));
    }

    public function create(){
    	$jenis = Jenis::get();
    	$ruang = Ruang::get();
    	$kode = DB::table('inventaris')->select('id')->max('id');
        $id = sprintf("KI%03s", $kode+1);
        $kode_inven = $id;
    	return view('inven.create',compact('jenis','ruang', 'kode_inven'));
    }

    public function save(Request $request){
    	$data = Inventaris::create([
    		'nama' => $request->nama,
    		'keterangan' => $request->keterangan,
    		'jumlah' => $request->jumlah,
    		'id_jenis' => $request->id_jenis,
    		'id_ruang' => $request->id_ruang,
    		'kode_inventaris' => $request->kode_inventaris,
    		'id_petugas' => $request->id_petugas,
            'jumlah_baik' => $request->jumlah,
    	]);
    	// dd($data);
    	return redirect()->route('inven.index')->with('success', 'Data Berhasil Tersimpan');
    }

    public function edit($id){
    	$data = Inventaris::where('id', $id)->first();
    	$jenis = Jenis::get();
    	$ruang = Ruang::get();
    	// dd($data);
    	return view('inven.edit', compact('data','jenis','ruang'));
    }

    public function update(Request $request,$id){
    	$data = Inventaris::where('id', $id)->update([
    		'nama' => $request->nama,
    		'keterangan' => $request->keterangan,
    		'jumlah' => $request->jumlah,
    		'id_jenis' => $request->id_jenis,
    		'id_ruang' => $request->id_ruang,
            'jumlah_baik' => $request->jumlah,
    	]);
    	// dd($data);
    	return redirect()->route('inven.index')->with('success', 'Data Berhasil Terupdate');
    }

    public function delete($id){
    	$data = Inventaris::where('id', $id)->first();
        $data->delete();
        return back()->with('success', 'Data Berhasil Terhapus');
    }


}
