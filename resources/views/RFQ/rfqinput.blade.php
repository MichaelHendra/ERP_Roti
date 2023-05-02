@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800 col-md-12">Masukan RFQ</h1>
        <form action="{{url('/rfq/data/input/proses')}}" method="post" name="input-form" id="input-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
                    <label for="nama_product">ID RFQ</label>
                    <input type="text" class="form-control" id="id_rfq" name="id_rfq" required>
                </div>
                <div class="form-group">
                    <label for="select_item">Pilih Vendor</label>
                    <br>
                    <select class="form-select" name="id_vendor">
                        @if($vendor->count())
                        @foreach($vendor as $item)
                        <option value="{{$item->id_vendor}}">{{$item->nama_vendor}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
                </div>
                
            </div>
        </form>
    </div>


</div>
@endsection