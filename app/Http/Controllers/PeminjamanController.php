<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Pegawai;
use App\Inventaris;
use App\DetailPinjam;
use App\Peminjaman;

class PeminjamanController extends Controller
{
    public function index(){
    	$datapeminjaman = DB::table('peminjaman')
    				->join('detail_pinjams', 'detail_pinjams.id_peminjaman', '=', 'peminjaman.id')
    				->join('inventaris', 'inventaris.id', '=', 'detail_pinjams.id_inventaris')
    				->join('pegawais', 'pegawais.id', '=', 'peminjaman.id_pegawai')
    				->select('peminjaman.id','inventaris.nama as nama_inventaris','detail_pinjams.id_inventaris','peminjaman.tanggal_pinjam','peminjaman.tanggal_kembali','detail_pinjams.jumlah','pegawais.nama_pegawai','peminjaman.id_petugas','peminjaman.status_peminjaman')
    				->get();            		
    	return view('peminjaman.index', compact('datapeminjaman'));
    }

    public function create(){
    	$pegawai = Pegawai::get();
    	$inventaris = Inventaris::get();
        // $kode = DB::table('peminjaman')->select('id')->max('id');
        // $id = sprintf("%01s", $kode+1);
        // $kode_inven = $id;

        // dd($kode_inven);
    	return view('peminjaman.create', compact('pegawai','inventaris'));
    }

    public function save(Request $request){
    	$jumlah = Inventaris::select('jumlah_baik')->where('id', $request->id_inventaris)->value('jumlah_baik');
    	if ($request->jumlah > $jumlah) {
    		return back()->with('error', 'Stok Barang Kurang');
    	}else{
	    	$tanggal_pinjam = date("Y-m-d H:i:s");
	    	$id_petugas = Auth::user()->id;
            $kode = DB::table('peminjaman')->select('id')->max('id');
            $id = sprintf("%01s", $kode+1);
            $id_peminjaman = $id;
    		$jumlah_baik = $jumlah - $request->jumlah;

    		$data_stor_peminjaman = Peminjaman::create([
				'tanggal_pinjam' => $tanggal_pinjam,
				'id_pegawai' => $request->id_pegawai,
				'id_petugas' => $id_petugas,
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
				return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Tersimpan');
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
        // dd($data_edit_pegawai);

        return view('peminjaman.edit', compact('data_edit_detail','data_edit_peminjaman','data_edit_pegawai','pegawai','inventaris'));
    }

    public function update(Request $req,$id){
        $input = $req->all();
        $jumlah = Inventaris::select('jumlah_baik')->where('id', $req->id_inventaris)->value('jumlah_baik');
        $id_petugas = Auth::user()->id;
        if ($input['jumlah'] > $jumlah) {
            return back()->with('error', 'Stok Barang Kurang');
        }elseif ($input['jumlah'] <= 0) {
            return back()->with(['message' => 'Jumlah harus diisi lebih dari 0','type' => 'warning']);
        }else{
            if ($input['old_id_inventaris']) {
                $lihatsebelumnya = Inventaris::where('id',$input['old_id_inventaris'])->first();

                $backjumlah = Inventaris::where('id',$input['old_id_inventaris'])->update([
                    'jumlah_baik' => $lihatsebelumnya['jumlah_baik'] + $input['old_jumlah'],
                    'jumlah' => $lihatsebelumnya['jumlah_baik'] + $lihatsebelumnya['jumlah_rusak'] + $input['old_jumlah']
                ]);
            }

            $peminjaman = Peminjaman::where('id',$id)->update([
                'id_pegawai' => $input['id_pegawai'],
                'id_petugas' => $id_petugas,
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

            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Terupdate');
        }
    }

    public function approve(Request $request,$id){
        $id_petugas = Auth::user()->id;
        $peminjaman = Peminjaman::where('id',$id)->update([
            'status_peminjaman' => 4,
            'id_petugas' => $id_petugas,
        ]);

        // dd($peminjaman);
        return back()->with('success', 'Anda Berhasil Menyetujui Peminjaman');
    }

    public function reject(Request $request,$id){
        $id_petugas = Auth::user()->id;
        $id_inventaris = DetailPinjam::where('id',$id)->first();
        $jumlah_inventaris = Inventaris::select('jumlah')->where('id',$id_inventaris['id_inventaris'])->value('jumlah');
        $jumlah = $jumlah_inventaris + $id_inventaris['jumlah'];

        $tolak = Peminjaman::where('id',$id)->update([
            'status_peminjaman' => 5,
            'id_petugas' => $id_petugas,
        ]);

        $newjumlah = Inventaris::where('id',$id_inventaris['id_inventaris'])->update([
            'jumlah' => $jumlah,
            'jumlah_baik' => $jumlah
        ]);
        return back()->with('success', 'Anda Telah Menolak Permintaan Peminjaman');
    }
}
