<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Pegawai;
use App\Inventaris;
use App\DetailPinjam;
use App\Peminjaman;

class PegawaiPinjamController extends Controller
{
	public function index(){
	    $datapeminjaman = DB::table('peminjaman')
                        ->join('detail_pinjams', 'detail_pinjams.id_peminjaman', '=', 'peminjaman.id')
                        ->join('inventaris', 'inventaris.id', '=', 'detail_pinjams.id_inventaris')
                        ->join('pegawais', 'pegawais.id', '=', 'peminjaman.id_pegawai')
                        ->select('peminjaman.id','inventaris.nama as nama_inventaris','detail_pinjams.id_inventaris',
                                'peminjaman.tanggal_pinjam','peminjaman.tanggal_kembali','detail_pinjams.jumlah',
                                'pegawais.nama_pegawai','peminjaman.id_petugas','peminjaman.status_peminjaman')        
                        ->get();                
        // dd($datapeminjaman);                            		
	    return view('pegawaisecond.peminjaman.index', compact('datapeminjaman'));
	}

	public function create(){
    	$pegawai = Pegawai::get();
    	$inventaris = Inventaris::get();
        $nama_pegawai = Auth::guard('pegawai')->user()->nama_pegawai;
        // $a = date("Y-m-d H:i:s");
        // dd($a);
        // $kode = DB::table('peminjaman')->select('id')->max('id');
        // $id = sprintf("%01s", $kode+1);
        // $kode_inven = $id;

        // dd($nama_pegawai);
    	return view('pegawaisecond.peminjaman.create', compact('pegawai','inventaris'));
    }

    public function save(Request $request){
    	$jumlah = Inventaris::select('jumlah_baik')->where('id', $request->id_inventaris)->value('jumlah_baik');
    	if ($request->jumlah > $jumlah) {
    		return back()->with('error', 'Stok Barang Kurang');
    	}else{
	    	$tanggal_pinjam = date("Y-m-d H:i:s");
	    	// $id_petugas = Auth::user()->id;
            $kode = DB::table('peminjaman')->select('id')->max('id');
            $id = sprintf("%01s", $kode+1);
            $id_peminjaman = $id;
    		$jumlah_baik = $jumlah - $request->jumlah;
            $nama_pegawai = Auth::guard('pegawai')->user()->id;

    		$data_stor_peminjaman = Peminjaman::create([
				'tanggal_pinjam' => $tanggal_pinjam,
				'status_peminjaman' => 3,
				'id_pegawai' => $nama_pegawai,
				// 'id_petugas' => $id_petugas,
			]);

			$data_stor_detail = DetailPinjam::create([
				'id_peminjaman' => $id_peminjaman,
				'id_inventaris' => $request->id_inventaris,
				'jumlah' => $request->jumlah
			]);

			$update_inventaris = Inventaris::where('id', $request->id_inventaris)->update([
				'jumlah_baik' => $jumlah_baik,
				'jumlah' => $jumlah_baik
			]);

			if ($data_stor_peminjaman AND $data_stor_detail AND $update_inventaris) {
                // dd($data_stor_peminjaman,$data_stor_detail,$update_inventaris);
				return redirect()->route('pegawaisecond.peminjaman.index')->with('success', 'Data Berhasil Tersimpan');
			} else {
				return back()->with('error', 'Gagal');
			}
    	}
    }

    public function edit($id){
    	$pegawai = Pegawai::get();
        $inventaris = Inventaris::get();

        $data_edit_detail = DetailPinjam::where('id',$id)->first();

        $id_peminjaman = DetailPinjam::select('id_peminjaman')->where('id',$data_edit_detail['id_peminjaman'])->value('id_peminjaman');
        $data_edit_peminjaman = Peminjaman::where('id',$id_peminjaman)->first();

        $id_pegawai = Peminjaman::select('id_pegawai')->where('id',$data_edit_peminjaman['id_pegawai'])->value('id_pegawai');
        $data_edit_pegawai = Pegawai::where('id',$id_pegawai)->first();
        // dd($id_pegawai);

        if ($id_pegawai == Auth::guard('pegawai')->user()->id) {
            return view('pegawaisecond.peminjaman.edit', compact('data_edit_detail','data_edit_peminjaman','data_edit_pegawai','pegawai','inventaris'));    
        }else{
            return back()->with('error','Anda Bukan Orang Yang Bersangkutan');
        }
        
    }

    public function update(Request $req,$id){
    	$input = $req->all();
        $jumlah = Inventaris::select('jumlah_baik')->where('id', $req->id_inventaris)->value('jumlah_baik');
        if ($input['jumlah'] > $jumlah) {
            return back()->with('error', 'Stok Barang Kurang');
        }elseif ($input['jumlah'] <= 0) {
            return back()->with(['message' => 'Jumlah harus diisi lebih dari 0','type' => 'warning']);
        }else{
            $nama_pegawai = Auth::guard('pegawai')->user()->id;
            if ($input['old_id_inventaris']) {
                $lihatsebelumnya = Inventaris::where('id',$input['old_id_inventaris'])->first();

                $backjumlah = Inventaris::where('id',$input['old_id_inventaris'])->update([
                    'jumlah_baik' => $lihatsebelumnya['jumlah_baik'] + $input['old_jumlah'],
                    'jumlah' => $lihatsebelumnya['jumlah_baik'] + $lihatsebelumnya['jumlah_rusak'] + $input['old_jumlah']
                ]);
            }

            $peminjaman = Peminjaman::where('id',$id)->update([
                'id_pegawai' => $nama_pegawai,
            ]);

            $detail = DetailPinjam::where('id_peminjaman',$id)->update([
                'id_inventaris' => $input['id_inventaris'],
                'jumlah' => $input['jumlah'],
            ]);

            $datainventaris = Inventaris::where('id',$input['id_inventaris'])->first();

            $update = Inventaris::where('id',$input['id_inventaris'])->update([
                'jumlah_baik' => $datainventaris['jumlah_baik'] - $input['jumlah'],
                'jumlah' => ($datainventaris['jumlah_baik'] + $datainventaris['jumlah_rusak']) - $input['jumlah'],
            ]);

            return redirect()->route('pegawaisecond.peminjaman.index')->with('success', 'Data Berhasil Terupdate');
        }    
    }
}
