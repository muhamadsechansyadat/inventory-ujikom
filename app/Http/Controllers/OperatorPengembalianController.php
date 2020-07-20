<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailKembali;
use DB;
use Auth;
use App\Pegawai;
use App\Inventaris;
use App\DetailPinjam;
use App\Peminjaman;

class OperatorPengembalianController extends Controller
{
	public function index(){
		$data = DetailKembali::get();
		// dd($data);
		return view('operator.pengembalian.index', compact('data'));
	}

    public function create($id){
		$pegawai = Pegawai::get();
        $inventaris = Inventaris::get();

        $data_create_detail = DetailPinjam::where('id',$id)->first();

        $id_peminjaman = DetailPinjam::select('id_peminjaman')->where('id',$data_create_detail['id_peminjaman'])->value('id_peminjaman');
        $data_create_peminjaman = Peminjaman::where('id',$id_peminjaman)->first();

        $id_pegawai = Peminjaman::select('id_pegawai')->where('id',$data_create_peminjaman['id_pegawai'])->value('id_pegawai');
        $data_create_pegawai = Pegawai::where('id',$id_pegawai)->first();
        // dd($data_create_detail,$data_create_peminjaman,$data_create_pegawai);

        // $jumlah = DetailPinjam::select('jumlah')->where('id', $id)->value('jumlah');
        // dd($jumlah);

        return view('operator.pengembalian.create', compact('data_create_detail','data_create_peminjaman','data_create_pegawai','pegawai','inventaris'));
    }

    public function save(Request $req,$id){
    	$input = $req->all();
        $jumlah = DetailPinjam::select('jumlah')->where('id', $id)->value('jumlah');
        if ($input['baik'] + $input['buruk'] > $jumlah) {
            return back()->with('error', 'Stok Barang Kurang');
        }elseif ($input['baik'] + $input['buruk'] <= 0) {
            return back()->with('error', 'Tidak Boleh Nol(0)');
        }elseif($input['baik'] + $input['buruk'] == $jumlah){
            if ($input['id_inventaris']) {
                $lihatsebelumnya = Inventaris::where('id',$input['id_inventaris'])->first();

                $backjumlah = Inventaris::where('id',$input['id_inventaris'])->update([
                    'jumlah_baik' => $lihatsebelumnya['jumlah_baik'] + $input['baik'],
                    'jumlah_buruk' => $lihatsebelumnya['jumlah_buruk'] + $input['buruk'],
                    'jumlah' => $lihatsebelumnya['jumlah_baik'] + $lihatsebelumnya['jumlah_buruk'] + $input['baik'] + $input['buruk'],
                ]);
            }

            $pengembalian = DetailKembali::create([
            	'id_inventaris' => $input['id_inventaris'],
            	'id_peminjaman' => $input['id_peminjaman'],
            	'baik' => $input['baik'],
            	'buruk' => $input['buruk'],
            ]);

            $peminjaman = Peminjaman::where('id',$input['id_peminjaman'])->update([
            	'tanggal_kembali' => date("Y-m-d H:i:s"),
            	'status_peminjaman' => 2
            ]);
            return redirect()->route('operator.peminjaman.index')->with('success', 'Sudah Di Kembalikan');
        }else{
        	return back()->with('error', 'Harap Kembalikan Sesuai Anda Pinjam');
        }
    }
}
