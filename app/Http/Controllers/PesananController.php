<?php

namespace App\Http\Controllers;

use App\Exports\PesananExport;
use App\Models\Detailpesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PesananController extends Controller
{
    public function index(){
        $datas = Pesanan::all();

        return view('admin.daftar-pesanan.index', [
            'pesanans' => $datas,
        ]);
    }

    public function detailpesanan($id){
        $datas = Detailpesanan::where('pesanan_id', $id)->get();
        $data = Pesanan::find($id);
    
        return view('admin.daftar-pesanan.detail', [
            'pesanans' => $datas,
            'pesanan_data' => $data
        ]);
    }

    public function exportexcel(){
        return Excel::download(new PesananExport, 'laporan-pesanan.xlsx');
    }
}
