<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class PegawaiController extends Controller
{
	public function index(){
		$data = Pegawai::orderBy('id','desc')->get();
		// dd($data);
		return view('pegawai.index', compact('data'));
	}

	public function create(){
		return view('pegawai.create');
	}

	public function save(Request $request){
		$data = Pegawai::create([
			'nama_pegawai' => $request->nama_pegawai,
			'nip' => $request->nip,
			'alamat' => $request->alamat,
			'username' => $request->username,
			'password' => bcrypt($request['password']),
		]);
		// dd($data);
		return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Tersimpan');
	}

	public function edit($id){
		$data = Pegawai::where('id', $id)->first();
		// dd($data);
		return view('pegawai.edit', compact('data'));
	}

	public function update(Request $request,$id){
		$data = Pegawai::where('id', $id)->update([
			'nama_pegawai' => $request->nama_pegawai,
			'nip' => $request->nip,
			'alamat' => $request->alamat,
			'username' => $request->username,
		]);

		// dd($data);
		return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Terupdate');
	}

	public function delete($id){
		$data = Pegawai::where('id',$id)->first();
		$data->delete();
		// dd($data);
		return back()->with('success', 'Data Berhasil Terhapus');
	}    
}
