<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;

class PegawaiController extends Controller
{
    public function index(){
    	$data = Pegawai::orderBy('id','desc')->get();
    	return response()->json($data);
    }

    public function save(Request $request){
    	$data = Pegawai::create([
			'nama_pegawai' => $request->nama_pegawai,
			'nip' => $request->nip,
			'alamat' => $request->alamat,
			'username' => $request->username,
			'password' => bcrypt($request['password']),
		]);
		$response['success'] = true;
        if ($data && $data->save()) {
            $response['message'] = 'Berhasil Di Simpan';
            $response['data'] = $data;
        }else{
            $response['success'] = false;
            $response['message'] = 'Gagal Tersimpan';
            $response['data'] = '';
        }
        return response()->json($response);
    }

    public function update(Request $request,$id){
    	$data = Pegawai::where('id', $id)->first();
    	$data->nama_pegawai = $request->nama_pegawai;
		$data->nip = $request->nip;
		$data->alamat = $request->alamat;
		$data->username = $request->username;
        $response['success'] = true;

        if ($data && $data->save()) {
            $response['message'] = 'Berhasil Di update';
            $response['data'] = $data;
        }else{
            $response['success'] = false;
            $response['message'] = 'Gagal Terupdate';
            $response['data'] = '';
        }

        return response()->json($response);
    }

    public function delete($id){
    	$data = Pegawai::where('id',$id)->first();
    	if ($data && $data->delete()) {
            $response['message'] = 'Berhasil Di Hapus';
            $response['data'] = $data;
        }else{
            $response['success'] = false;
            $response['message'] = 'Gagal Terhapus';
            $response['data'] = '';
        }

        return response()->json($response);
    }
}
