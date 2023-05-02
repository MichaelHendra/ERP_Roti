@extends('index')
@section('content')

<div class="container-fluid">
    <form action="{{route('ProsesInputVendor')}}" method="post" name="input-form" id="input-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="kode_produk">ID Vendor</label>
            <input type="text" class="form-control" id="id_vendor" name="id_vendor">
        </div>
        <div class="form-group">
            <label for="nama_product">Nama Vendor</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor">
        </div>
        <div class="form-group">
            <label for="harga_product">Telpon</label>
            <input type="text" class="form-control" id="telpon" name="telpon">
        </div>
        <div class="form-group">
            <label for="deskripsi_product">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
        </div>
        <div class="input-group input-group-outline my-3">
            <input class="form-control-radio" type="radio" name="status" id="flexRadioDefault1" value="1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Vendor
            </label>
        </div>
        <div class="input-group input-group-outline my-3">
            <input class="form-control-radio" type="radio" name="status" value="2" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                User
            </label>
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
    </form>
</div>

    
@endsection