<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Image;
use File;


class ProdukController extends Controller{
    public function kabehProduk(){
        $produk = ProdukModel::all();
        return view('Produk/produk',['data' =>$produk]);
    }
    public function produkInput(){
        return view('Produk/input-produk');
    }
    
    public function produkUpload(Request $request){
        $this->validate($request, [
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);
        if($request->hasFile('gambar')){
            $image = $request->file('gambar');
            $nama_gambar = time()."_".$image->getClientOriginalName();
            $destinationPath = public_path('/gambar');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(150, 150, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$nama_gambar);
            $image->move($destinationPath,$nama_gambar);
        }else{
            $nama_gambar = "placeholder.png";
        }
        ProdukModel::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'qty' => 0,
            'harga' => $request->harga,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'gambar' => $nama_gambar
        ]);
        return redirect('/produk');
    }
    public function produkEditView($kode_produk)
    {
        $produk = ProdukModel::find($kode_produk);
        return view('Produk/update-produk',compact('produk'),['produk'=>$produk]);
    }
    public function produkUpdate(Request $request,$kode_produk){
        $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);
        $produk = ProdukModel::find($kode_produk);
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->status = $request->status;

        if($request->hasfile('gambar')) {

            File::delete('gambar/'.$produk->gambar);
            $image = $request->file('gambar');
            $nama_gambar = time()."_".$image->getClientOriginalName();
            $destinationPath = public_path('/gambar');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$nama_gambar);
            $image->move($destinationPath, $nama_gambar);
            
            $produk->gambar = $nama_gambar;
        } 
        $produk->save();
        return redirect('/produk');
    }
    public function Produkdelete($kode_produk)
    {
        $produk = ProdukModel::find($kode_produk);
        File::delete('gambar/' . $produk->gambar);

        // hapus data
        $produk->delete();
        return redirect('/produk');
    }
}

