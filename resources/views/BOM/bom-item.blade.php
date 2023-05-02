@extends('index')
@section('content')
<div class="container">
    <form action="{{ url('/bom/item_list/upload') }}" method="post" name="input-form" id="input-form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="kode_bom">Kode Bom</label>
            <input type="hidden" class="form-control" name="kode_bom" id="kode_bom" value="{{$bom->kode_bom_list}}" readonly>
            <input type="text" class="form-control" name="kode_bom" id="kode_bom" value="{{$bom->kode_bom}}" readonly>
        </div>
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" value="{{$bom->nama_produk}}" disabled>
        </div>
        <div class="form-group">
            <label for="select_item">Pilih Material</label>
            <div class="dropdown">
                <select class="form-select" name="kode_produk">
                    @if($materials->count())
                    @foreach($materials as $item)
                    <option value="{{$item->kode_produk}}" data-toggle="">{{$item->nama_produk}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
            <div class="form-group">
                <label for="banyak">Banyak Bahan</label>
                <input type="text" class="form-control" name="qty" id="quantity">
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <div class="dropdown">
                    <select class="form-select" name="satuan" id="satuan">
                        <option class="dropdown-item">Gram</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-3">
                <button type="submit" name="simpan" class="btn btn-primary">Tambah Bahan</button>
            </div>
    </form>
</div>
<div class="container-fluid mt-4">
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Bahan</th>
                <th scope="col">Banyak</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($list->count())
            @foreach($list as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->kode_bom}}</td>
                <td>{{$item->nama_produk}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->harga}}</td>
                @php
                {{
                    $total = $item->harga * $item->qty;
                }}
                @endphp
                <td>{{$total}}</td>
                <td>
                    <a href="{{ url('/bom/delete_item_list/'.$item->kode_bom_list) }}" class="btn btn-danger delete-confirm" role="button">Hapus</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="container-sm ">
        <div class="row"></div>
        <div class="row mt-auto p-2 bd-highlight">
            <label for="text_harga" class="font-weight-bold"> Total Harga : </label>
            <label for="total_harga" id="val">{{ $bom->total_harga }}</label>
        </div>
    </div>
</div>
@endsection