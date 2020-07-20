<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;

class LevelController extends Controller
{
    public function index(){
    	$data = Level::orderBy('id','desc')->get();
    	// dd($data);
    	return view('level.index', compact('data'));
    }

    public function create(){
    	return view('level.create');
    }

    public function save(Request $request){
    	$data = Level::create([
    		'nama_level' => $request->nama_level,
    	]);
    	// dd($data);
    	return redirect()->route('level.index')->with('success', 'Data Berhasil Tersimpan');
    }

    public function edit($id){
    	$data = Level::where('id',$id)->first();
    	// dd($data);
    	return view('level.edit', compact('data'));
    }

    public function update(Request $request,$id){
    	$data = Level::where('id', $id)->update([
    		'nama_level' => $request->nama_level,
    	]);
    	// dd($data);
    	return redirect()->route('level.index')->with('success', 'Data Berhasil Terupdate');
    }

    public function delete($id){
    	$data = Level::where('id', $id)->first();
    	$data->delete();
    	return back()->with('success', 'Data Berhasil Terhapus');
    }
}
