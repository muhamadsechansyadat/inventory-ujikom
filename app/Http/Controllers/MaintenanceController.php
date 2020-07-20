<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventaris;

class MaintenanceController extends Controller
{
    public function index(){
        $data = Inventaris::get();
        return view('maintenance.index', compact('data'));
    }

    public function edit($id){
        $data = Inventaris::where('id', $id)->first();
        // dd($jumlahburuk);
        return view('maintenance.edit', compact('data'));
    }

    public function update(Request $request,$id){
        $data = Inventaris::where('id', $id)->first();
        $jumlahbaik = Inventaris::select('jumlah_baik')->where('id',$data['id'])->value('jumlah_baik');
        $jumlahburuk = Inventaris::select('jumlah_buruk')->where('id',$data['id'])->value('jumlah_buruk');
        if($request->jumlah_buruk > $jumlahburuk){
            return back()->with('error', 'Data Yang anda input terlalu banyak');
        }elseif($request->jumlah_buruk == '0'){
            return back()->with('error', 'Data tidak boleh nol');
        }else{
            $data = Inventaris::where('id', $id)->update([
                'jumlah_baik' => $jumlahbaik + $request->jumlah_buruk,
                'jumlah_buruk' => $jumlahburuk - $request->jumlah_buruk,
            ]);
            return redirect()->route('maintenance.index')->with('success','Data Berhasil Tersimpan');
        }
    }


}
