@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800 col-md-12">Masukan Bill of Materials</h1>
        <form action="{{ url('/bom/bomMasuk') }}" method="post" name="input-form" id="input-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
                    <label for="nama_product">ID Bom</label>
                    <input type="text" class="form-control" id="kode_bom" name="kode_bom" required>
                </div>
                <div class="form-group">
                    <label for="select_item">Pilih Produk</label>
                    <br>
                    <select class="form-select" name="kode_produk">
                        @if($produk->count())
                        @foreach($produk as $item)
                        <option value="{{$item->kode_produk}}">{{$item->nama_produk}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
                </div>
            </div>
        </form>
    </div>


</div>
@endsection