<?php

namespace App\Http\Controllers;

use App\Models\RfqModel;
use App\Models\SQModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class AkunController extends Controller
{
    public function AkunTampil()
    {
        return view('Akun/Akun');
    }
    public function invoice()
    {
        $sq = SQModel::join('t_vendor','t_vendor.id_vendor','=','t_sq.id_pelanggan')
        ->get(['t_sq.*','t_vendor.nama_vendor','t_vendor.status as l']);
        $tot = DB::table('t_sq')->sum('total_harga');
        return view('Akun/AkunSQ',['sqs' => $sq,'tots'=>$tot]);
    }
    public function invoicePertanggal(Request $request)
    {   
        $dar = $request->tqlawal;
        $sq = SQModel::join('t_vendor','t_vendor.id_vendor','=','t_sq.id_pelanggan')
        ->where('t_sq.tanggal_transaksi',$dar)->get(['t_sq.*','t_vendor.nama_vendor','t_vendor.status as l']);
        $tot = DB::table('t_sq')->where('t_sq.tanggal_transaksi',$dar)->sum('total_harga');
        return view('Akun/AkunSQ',['sqs' => $sq,'tots'=>$tot]);
    }
    public function bill()
    {
        $rfq = RfqModel::join('t_vendor','t_vendor.id_vendor','=','t_rfq.id_vendor')
        ->get(['t_rfq.*','t_vendor.nama_vendor','t_vendor.status as l']);
        $tot = DB::table('t_rfq')->sum('total_harga');
        return view('Akun/AkunRFQ',['rfqs' => $rfq,'tots'=>$tot]);
    }
    public function billPertanggal(Request $request)
    {   
        $dar = $request->tqlawal;
        $rfq = RfqModel::join('t_vendor','t_vendor.id_vendor','=','t_rfq.id_vendor')
        ->where('t_rfq.tanggal',$dar)->get(['t_rfq.*','t_vendor.nama_vendor','t_vendor.status as l']);
        $tot = DB::table('t_rfq')->where('t_rfq.tanggal',$dar)->sum('total_harga');
        return view('Akun/AkunRFQ',['rfqs' => $rfq,'tots'=>$tot]);
    }
}
