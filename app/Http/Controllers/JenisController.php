<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;
use DB;

class JenisController extends Controller
{
    public function index(){
        $data = Jenis::orderBy('id','desc')->get();
        // dd($data);
        return view('jenis.index', compact('data'));
    }

    public function create(){
        $kode = DB::table('jenis')->select('id')->max('id');
        $id = sprintf("JB%03s", $kode+1);
        $kode_jenis = $id;
        //dd($no_surat);
        return view('jenis.create', compact('kode_jenis'));
    }

    public function save(Request $request){
        $data = Jenis::create([
            'nama_jenis' => $request->nama_jenis,
            'kode_jenis' => $request->kode_jenis,
            'keterangan' => $request->keterangan,
        ]);
        // dd($data);
        return redirect()->route('jenis.index')->with('success','Data Berhasil Tersimpan');
    }

    public function edit($id){
        $data = Jenis::where('id',$id)->first();
        return view('jenis.edit', compact('data'));
    }

    public function update(Request $request,$id){
        $data = Jenis::where('id',$id)->update([
            'nama_jenis' => $request->nama_jenis,
            'kode_jenis' => $request->kode_jenis,
            'keterangan' => $request->keterangan,
        ]);
        // dd($data);
        return redirect()->route('jenis.index')->with('success','Data Berhasil Terupdate');
    }

    public function delete($id){
        $data = Jenis::where('id',$id)->first();
        $data->delete();
        return back()->with('success','Data Berhasil Terhapus');
    }
}