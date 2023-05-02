@extends('index')
@section('content')
<div class="container">
    <form action="{{url('/rfq/data/list/proses')}}" method="post" name="input-form" id="input-form">
      {{ csrf_field() }}
      <div class="form-group mt-3">
        <label for="id_rfq">ID RFQ</label>
        <input type="text" class="form-control" id="id_rfq" value="{{$rfq->id_rfq}}" name="id_rfq" readonly>
      </div>
      <div class="form-group mt-3">
        <label for="vendor">Vendor</label>
        <input type="text" class="form-control" id="vendor" value="{{$rfq->nama_vendor.' - '.$rfq->alamat}}" name="vendor" readonly>
      </div>
      @if($rfq->status == 0 )
      <label for="kode_produk">Pilih Produk</label>
      <div class="dropdown">
        <select class="form-select" name="kode_produk">
          @if($produk->count())
          @foreach($produk as $item)
          <option value="{{$item->kode_produk}}" data-toggle="">{{$item->nama_produk}}</option>
          @endforeach
          @endif
        </select>
      </div>
      <div class="form-group mt-3">
        <label for="qty_rfq">Quantity</label>
        <input type="text" class="form-control" id="qty" name="qty" required>
      </div>
      <div class="dropdown">
        <label for="satuan">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" value="Gram" readonly>
        </div>
      </div>
      <button type="submit" name="simpan" class="btn btn-primary my-3">Add Bahan</button>
      @endif
    </form>
    <div class="container-fluid">
      <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama</th>
            <th scope="col">Banyak</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if($List->count())
          @foreach($List as $item)
          <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$item->kode_produk}}</td>
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
            @if($rfq->status == 0)
            <td>
              <a href="{{ url('product/bom-delete-item/'.$item->kode_bom_list) }}" class="btn btn-danger delete-confirm" role="button">Hapus</a>
            </td>
            @else
            <td>
            </td>
            @endif
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
    <label for="text_harga" class="font-weight-bold"> Total Harga : </label>
    
    <label for="total_harga" id="val"> {{$rfq->total_harga}}</label>
    <br>
    @if($rfq->status == 0 )
    <form action="{{url('/rfq/data/list/saveitem/'.$rfq->id_rfq)}}" method="post" class="btn p-0" name="input-form" id="input-form">
      {{ csrf_field() }}
      <input type="text" id="kode_rfq" value="" name="kode_rfq" hidden>
      <button type="submit" onclick="return confirm('Confirm Order?');" class="btn btn-success">Confirm Order</button>
    </form>
    <button class="btn btn-danger">Discard</button>
    @elseif($rfq->status == 1)
    <form action="{{url('/rfq/data/list/Pembayaran/'.$rfq->id_rfq)}}" method="post" class="p-0" name="input-form" id="input-form">
      {{ csrf_field() }}
      <label>Pilih Pembayaran :</label>
      <div class="form-group">
        <input class="form-control-radio" type="radio" name="payment" id="flexRadioDefault1" value="1" checked>
        <label class="form-check-label" for="flexRadioDefault1">
          Cash
        </label>
      </div>
      <div class="form-group">
        <input class="form-control-radio" type="radio" name="payment" value="2" id="flexRadioDefault2">
        <label class="form-check-label" for="flexRadioDefault2">
          Transfer
        </label>
      </div>
      <input type="text" id="kode_rfq" value="" name="kode_rfq" hidden>
      <button type="submit" onclick="return confirm('Proses Create Bill?');" class="btn btn-success">Create Bill</button>
    </form>
    @elseif($rfq->status == 2)
    <label>Metode Pembayaran : 
      {{$rfq->pembayaran == 1 ? 'Cash' : 'Transfer'}}
    </label><br>
    <form action="{{url('/rfq/data/list/Pembayaran/confirm/'.$rfq->id_rfq)}}" method="post" class="btn p-0" name="input-form" id="input-form">
      {{ csrf_field() }}
      <input type="text" id="id_rfq" value="" name="id_rfq" hidden>
      <button type="submit" onclick="return confirm('Confirm Bill?');" class="btn btn-success">Confirm Bill</button>
    </form>
    @elseif($rfq->status == 3)
    <label>Metode Pembayaran : 
      {{$rfq->pembayaran == 1 ? 'Cash' : 'Transfer'}}
    </label><br>
    <label>Status Pembayaran : Lunas 
    </label><br>
    @endif
  </div>
@endsection