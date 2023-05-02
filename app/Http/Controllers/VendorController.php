<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function VendorTampil()
    {
        $vendor_tok = VendorModel::all();
        return view('Vendor_user/vendor',['vendors'=>$vendor_tok]);
    }
    public function inputVendorTampil()
    {
        return view('Vendor_user/vendorinput');
    }
    public function inputVendor(Request $request)
    {
        $this->validate($request,[
            'id_vendor' => 'required',
            'nama_vendor' => 'required',
            'telpon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        VendorModel::create([
            'id_vendor' => $request->id_vendor,
            'nama_vendor' =>  $request->nama_vendor,
            'telpon' => $request->telpon,
            'alamat' => $request->alamat,
            'status' => $request->status
        ]);
        return redirect(route('Vendor'));
    }
    public function editVendorTampil($id_vendor)
    {
        $vendors=VendorModel::find($id_vendor);
        return view('Vendor_user/vendoredit',compact('vendors'),['vendors'=>$vendors]);
    }

    public function editVendor(Request $request,$id_vendor)
    {
        $this->validate($request,[
            'nama_vendor' => 'required',
            'telpon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);
        $vendors=VendorModel::find($id_vendor);
        $vendors->nama_vendor = $request->nama_vendor;
        $vendors->alamat = $request->alamat;
        $vendors->telpon = $request->telpon;
        $vendors->status = $request->status;
        $vendors->save();
    return redirect(route('Vendor'));
    }
    public function deleteVendor($id_vendor)
    {
        $vendors=VendorModel::find($id_vendor);
        $vendors->delete();

        return redirect(route('Vendor'));
    }
}
