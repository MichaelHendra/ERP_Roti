@extends('index')
@section('content')
<div class="container-fluid mb-3">
    <a href="{{route('bill')}}" class="btn btn-primary">Akuntansi RFQ</a>
    <a href="{{route('invoice')}}" class="btn btn-primary">Akuntansi SQ</a>
    <div class="form-group mt-4">
    <form action="{{url('/Akun/SQ/tanggal/')}}" method="POST">
        {{ csrf_field() }}  
    <input type="date" name="tqlawal" id="tqlawal">
    <button type="submit" class="btn btn-primary">Cari</button>
    </form>
    </div>
</div>
    <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pembayaran</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if($sqs->count())
            @foreach($sqs as $item)
            @php   
            @endphp
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nama_vendor}}</td>
                <td>{{$item->tanggal_transaksi}}</td>
                <td>{{$item->total_harga}}</td>
                <td> 
                  @if($item->metode_pembayaran == 0 )
                  <span class="badge bg-secondary">Belum Dibuat</span>
                  @elseif($item->metode_pembayaran == 1)
                  <span class="badge bg-primary">Cash</span>
                  @elseif($item->metode_pembayaran == 2)
                  <span class="badge bg-primary">Transfer</span>
                  @endif
                </td>
                <td>
                  @if($item->status == 1 )
                  <span class="badge bg-primary">Membuat Pesanan</span>
                  @elseif($item->status == 2)
                  <span class="badge bg-secondary">Menunggu Pembayaran</span>
                  @elseif($item->status == 3)
                  <span class="badge bg-success text-light">Selesai</span>
                  @endif
                </td>
              </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7"> No record found </td>
            </tr>
           @endif
        </tbody>
    </table>
    <div class="container-sm ">
      <div class="row"></div>
      <div class="row mt-auto p-2 bd-highlight">
          <label for="text_harga" class="font-weight-bold"> Total Harga : </label>
          @if($tots == 0)
          <label for="total_harga" id="val">xxxxxx</label>
          @else
          <label for="total_harga" id="val">{{ $tots }}</label>
          @endif
        
      </div>
@endsection