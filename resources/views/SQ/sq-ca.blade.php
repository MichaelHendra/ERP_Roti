@extends('index')
@section('content')
<div class="container">
    <form action="{{ url('product/sales-input-item') }}" method="post" name="input-form" id="input-form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="kode_bom">ID SQ</label>
            <input type="text" class="form-control" name="id_sq" id="id_sq" value="{{$sq->id_sq}}" readonly>
        </div>
        <div class="form-group">
            <label for="nama_customer">Nama Customer</label>
            <input type="text" class="form-control" id="nama_pelanggan" value="{{$sq->nama_vendor}}" disabled>
        </div>
        <div class="form-group">
            <label for="nama_customer">Alamat Customer</label>
            <input type="text" class="form-control" id="alamat" value="{{$sq->alamat}}" disabled>
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
                <th scope="col">On Hand</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if($list->count())
            @foreach($list as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->kode_produk}}</td>
                <td>{{$item->nama_produk}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->harga}}</td>
                <td>{{$item->l}}</td>
                <td>
                    @if($item->l < ($item->qty))
                        <a href="{{ url('/mo') }}" class="btn btn-danger delete-confirm" style="color: black" role="">Produk Kurang</a>
                        @else
                        <span class="badge badge-success" style="color: black" >Tersedia</span>
                        @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="container-sm ">
        <div class="row"></div>
        <!-- <div class="row mt-auto p-2 bd-highlight">
            <label for="text_harga" class="font-weight-bold"> Total Harga : </label>
            <label for="total_harga" id="val"> XXXXX</label>
        </div> -->
    </div>
    @if($avail == true && $sq->status == 1)
    <form action="{{ url('/SQ/data/list/ca/'.$sq->id_sq)}}" method="post" class="" name="input-form" id="input-form">
        {{ csrf_field() }}
        <label>Pilih Pembayaran :</label>
        <div class="form-group">
            <input class="form-control-radio" type="radio" name="metode_pembayaran" id="flexRadioDefault1" value="1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Cash
            </label>
        </div>
        <div class="form-group">
            <input class="form-control-radio" type="radio" name="metode_pembayaran" value="2" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Transfer
            </label>
        </div>
        <input type="text" id="kode_sales" value="{{$sq->id_sq}}" name="id_sq" hidden>
        <button type="submit" onclick="return confirm('Anda Yakin?');" class="btn btn-info">Buat Pesanan</button>
    </form>
    @elseif($avail == true && $sq->status == 2)
    <label>Metode Pembayaran :
        {{$sq->metode_pembayaran == 1 ? 'Cash' : 'Transfer'}}
    </label><br>
    <label>Total Tagihan : Rp.
        {{$sq->total_harga}}
    </label><br>
    <form action="{{ url('/SQ/data/list/bp/'.$sq->id_sq)}}" method="post" class="" name="input-form" id="input-form">
        {{ csrf_field() }}  
        <input type="text" id="id_sq" value="{{$sq->id_sq}}" name="id_sq" hidden>
        <button class="btn btn-primary">Cetak</button>
        <button type="submit" onclick="return confirm('Finish Payment?');" class="btn btn-success">Finish Payment</button>
    </form>
    @endif
</div>
@endsection