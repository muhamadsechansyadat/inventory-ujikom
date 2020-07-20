<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruang;

class RuangController extends Controller
{
    public function index(){
        $data = Ruang::orderBy('id','desc')->get();
        // dd($data);
        return view('ruang.index', compact('data'));
    }

    public function getid(){
        $data = Ruang::get();
        return view('layouts.template', compact('data'));
    }

    public function create(){
        return view('ruang.create');
    }

    public function save(Request $request){
        $data = Ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'kode_ruang' => $request->kode_ruang,
            'keterangan' => $request->keterangan,
        ]);
        // dd($data);
        return redirect()->route('ruang.index')->with('success','Data Berhasil Tersimpan');
    }

    public function edit($id){
        $data = Ruang::where('id',$id)->first();
        return view('ruang.edit', compact('data'));
    }

    public function update(Request $request,$id){
        $data = Ruang::where('id',$id)->update([
            'nama_ruang' => $request->nama_ruang,
            'kode_ruang' => $request->kode_ruang,
            'keterangan' => $request->keterangan,
        ]);
        // dd($data);
        return redirect()->route('ruang.index')->with('success','Data Berhasil Terupdate');
    }

    public function delete($id){
        $data = Ruang::where('id',$id)->first();
        $data->delete();
        return back()->with('success','Data Berhasil Terhapus');
    }
}
