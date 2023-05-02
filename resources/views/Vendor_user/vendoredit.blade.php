@extends('index')
@section('content')
<div class="container-fluid">
    <form action="{{ url('/vendor_user/edit/upload/'.$vendors->id_vendor) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="kode_produk">ID Vendor</label>
            <input type="text" class="form-control" id="id_vendor" name="id_vendor" value="{{$vendors->id_vendor}}" disabled>
        </div>
        <div class="form-group">
            <label for="nama_product">Nama Vendor</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{$vendors->nama_vendor}}">
        </div>
        <div class="form-group">
            <label for="harga_product">Telpon</label>
            <input type="text" class="form-control" id="telpon" name="telpon" value="{{$vendors->telpon}}">
        </div>
        <div class="form-group">
            <label for="deskripsi_product">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
        </div>
        <div class="form-group">
            <input class="form-control-radio" type="radio" name="status" id="flexRadioDefault1" value="1" >
            <label class="form-check-label" for="flexRadioDefault1">
                Vendor
            </label>
        </div>
        <div class="form-group">
            <input class="form-control-radio" type="radio" name="status" value="2" id="flexRadioDefault2" >
            <label class="form-check-label" for="flexRadioDefault2">
                User
            </label>
        </div>
    <div class="form-group">
            <button class="btn btn-primary" type="submit" name="simpan">Update</button>
            <a href="{{ route('Vendor')}}" class="btn btn-danger">Batal</a></div>
        
    </form>
</div>
    
@endsection