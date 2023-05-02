@extends('index')
@section('content')
<div class="container-fluid">
    <form action="{{ route('UploadProduk')}}" method="post" name="input-form" id="input-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Kode Produk" required>
        </div>
        <div class="input-group input-group-outline my-3">
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
        </div>
        <div class="input-group input-group-outline my-3">
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required>
        </div>
        <div class="input-group input-group-outline my-3">
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" rows="3"></textarea>
        </div>
        <div class="input-group input-group-outline my-3">
            <input class="form-control-radio" type="radio" name="status" id="flexRadioDefault1" value="1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Produk
            </label>
        </div>
        <div class="input-group input-group-outline my-3">
            <input class="form-control-radio" type="radio" name="status" value="2" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Bahan
            </label>
        </div>
        <div class="input-group input-group-outline my-3">
            <label for="exampleFormControlFile1">Pilih Gambar Product</label>
            <input type="file" class="form-control-file" id="gambar" name="gambar">
        </div>

        <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
    </form>
</div>
@endsection