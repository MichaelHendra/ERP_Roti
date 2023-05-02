<?php

namespace App\Http\Controllers;

use App\Models\BomListModel;
use App\Models\MoModel;
use App\Models\BomModel;
use App\Models\ProdukModel;
use App\Models\ProSemenModel;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoController extends Controller{

    
    public function manufactureOrder(){
        $moDatas = MoModel::join('t_bom', 't_mo.kode_bom', '=', 't_bom.kode_bom')
        ->join('t_produk', 't_bom.kode_produk', '=', 't_produk.kode_produk')
        ->get(['t_mo.*', 't_produk.nama_produk','t_produk.qty as l']);
        $boms = BomModel::join('t_produk', 't_bom.kode_produk', '=', 't_produk.kode_produk')
        ->get(['t_bom.*', 't_produk.nama_produk']);
        
        
        $bomslist = BomListModel::get('t_bom_list.kode_bom');
        foreach($bomslist as $kode){
            $produk = DB::table('t_produk')
            ->join('t_bom_list','t_produk.kode_produk','=','t_bom_list.kode_produk')
            ->join('t_mo','t_mo.kode_bom','=','t_bom_list.kode_bom')
            ->where('t_mo.kode_bom','=', $kode->kode_bom)
            ->get(['t_produk.nama_produk as l','t_produk.qty as h', 't_bom_list.*']);
            
        }
        return view('MO/MO',['moDatas' => $moDatas, 'boms' => $boms, 'produks' => $produk]);
    }
    public function moUpload(Request $request){
        MoModel::create([
            'kode_mo' => $request->kode_mo,
            'kode_bom' => $request->kode_bom,
            'qty' => $request->qty,
            'status' => 1,
        ]);
        return redirect('/mo');
    }
    public function moUpdate($kode_mo,Request $request){
        $mo = MoModel::find($kode_mo);
        $mo->status = $mo->status + 1;
        $mo->kode_bom =  $mo->kode_bom;
        $mo->qty =  $mo->qty;
        $mo->save();
        return redirect('/mo');
    }
    
    public function getAvailability($bomList, $mo)
    {
        $avail = true;
        foreach ($bomList as $item) {
            if ($item->l < ($item->qty * $mo->qty)) {
                $avail = false;
            } else {
                $avail = true;
            }
        }
        return $avail;
    }
    
    public function caItems($kode_mo)
    {
        $mo = MoModel::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bom = BomModel::join('t_produk', 't_bom.kode_produk', '=', 't_produk.kode_produk')
        ->where('t_bom.kode_bom', $kode_bom)
            ->first(['t_bom.*', 't_produk.nama_produk', 't_produk.harga']);
        $bomList = BomListModel::join('t_produk', 't_bom_list.kode_produk', '=', 't_produk.kode_produk')
            ->where('t_bom_list.kode_bom', $kode_bom)
            ->get(['t_bom_list.*', 't_produk.nama_produk', 't_produk.harga', 't_produk.qty as l']);
        $produk = ProdukModel::where('status', 2)->get();
        $avail = $this->getAvailability($bomList, $mo);
        return view('MO/mo-ca', ['bom' => $bom, 'materials' => $produk, 'mo' => $mo, 'list' => $bomList, 'avail' => $avail]);
    }
    public function moProduce($kode_mo)
    {
        $mo = MoModel::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bomList = BomListModel::join('t_produk', 't_bom_list.kode_produk', '=', 't_produk.kode_produk')
            ->where('t_bom_list.kode_bom', $kode_bom)
            ->get(['t_bom_list.*', 't_produk.nama_produk', 't_produk.harga', 't_produk.qty as l']);
        foreach ($bomList as $list) {
            ProSemenModel::create([
                'kode_bom_list' => $list->kode_bom_list,
                'qty_order' => $list->qty * $mo->qty,
            ]);
        }
        $mo->status = $mo->status + 1;
        $mo->save();
        return redirect('/mo');
    }

    public function moProsesProduce($kode_mo)
    {
        $mo = MoModel::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bomList = BomListModel::join('t_produk', 't_bom_list.kode_produk', '=', 't_produk.kode_produk')
            ->where('t_bom_list.kode_bom', $kode_bom)
            ->get(['t_bom_list.*', 't_produk.nama_produk', 't_produk.harga', 't_produk.qty']);
        $bom = BomModel::find($kode_bom);
        $produk = ProdukModel::find($bom->kode_produk);
        $produk->qty = $produk->qty + $mo->qty;
        $produk->save();
        foreach ($bomList as $list) {
            $temp =  ProSemenModel::where('kode_bom_list', $list->kode_bom_list)->get()->first();   
            $produk = ProdukModel::find($list->kode_produk);
            $produk->qty = $produk->qty - $temp->qty_order;
            $produk->save();
            $tempDelete =  ProSemenModel::find($temp->id);
            $tempDelete->delete();
        }
        $mo->status = 5;
        $mo->save();
        return redirect('/mo');
    }

}
