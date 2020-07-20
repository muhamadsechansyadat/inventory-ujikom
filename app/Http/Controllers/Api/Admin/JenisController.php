<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jenis;

class JenisController extends Controller
{
    public function index(){
    	$data = Jenis::orderBy('id','desc')->get();
    	return response()->json($data);
    }
}
