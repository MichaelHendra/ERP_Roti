@extends('index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800 col-md-12">Add SQ</h1>
        <form action="{{ route('SQProses') }}" method="post" name="input-form" id="input-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
                    <label for="nama_product">ID SQ</label>
                    <input type="text" class="form-control" id="id_sq" name="id_sq" required>
                </div>
                <div class="form-group">
                    <label for="select_item">Pilih User</label>
                    <br>
                    <select class="form-select" name="id_pelanggan">
                        @if($users->count())
                        @foreach($users as $item)
                        <option value="{{$item->id_vendor}}">{{$item->nama_vendor}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-grup mt-4">
                    <button class="btn btn-primary" type="submit" name="simpan">Tambah</button>
                </div>
                
            </div>
        </form>
    </div>


</div>
@endsection