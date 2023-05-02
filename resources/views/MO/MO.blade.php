@extends('index')
@section('content')
<div class="container mt-4">
  <form action="{{ route('moUpload') }}" method="post" name="input-form" id="input-form">
    {{ csrf_field() }}
    <div class="form-group mt-3">
      <label for="kode_produk">Kode MO</label>
      <input type="text" class="form-control" id="kode_mo" name="kode_mo" required>
    </div>
    <div class="form-group">
      <label for="select_item">Pilih Material</label>
      <div class="dropdown">
        <select class="form-select" name="kode_bom">
          @if($boms->count())
          @foreach($boms as $item)
          <option value="{{$item->kode_bom}}" data-toggle="">{{$item->kode_bom}} - {{$item->nama_produk}}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="form-group mt-3">
      <label for="kode_produk">Banyak</label>
      <input type="text" class="form-control" id="quantity" name="qty" required>
    </div>
    <div class="form-group mt-3">
      <button type="submit" class="btn btn-info">Add</button>
    </div>
  </form>

  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">ID Manufacture</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Banyak</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if($moDatas->count())
      @foreach($moDatas as $item)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$item->kode_mo}}</td>
        @if($item->status == 3)
        <td>{{$item->nama_produk}}</td>
        @else
        <td>{{$item->nama_produk}}</td>
        @endif
        <td>{{$item->qty}}</td>
        <td>
          @if($item->status == 1 )
          <span class="badge badge-secondary" style="color: black">Backlog</span>
          @elseif($item->status == 2)
          <span class="badge badge-primary" style="color: black">Ditandai</span>
          @elseif($item->status == 3)
          <span class="badge badge-warning" style="color: black">Cek Ketersediaan</span>
          @elseif($item->status == 4)
          <span class="badge badge-secondary" style="color: black">Produksi</span>
          @elseif($item->status == 5)
          <span class="badge badge-success" style="color: black">Selesai</span>
          @endif

        </td>
        <td>
          @if($item->status == 1 )
          <form action="/mo/update/{{$item->kode_mo}}" method="post">
            @method('put')
            {{ csrf_field() }}
            <button type="submit" onclick="return confirm('Proses Mark as todo?');" class="btn btn-info">Tandai</button>
          </form>
          @elseif($item->status == 2)
          <form action="/mo/update/{{$item->kode_mo}}" method="post">
            @method('put')
            {{ csrf_field() }}
            <button type="submit" onclick="return confirm('Proses CA?');" class="btn btn-info">Cek Ketersediaan</button>
          </form>
          @elseif($item->status == 3)
          <a href="{{ url('/mo/update/produk/cek/'.$item->kode_mo) }}" class="btn btn-primary" >Cek Ketersediaan</a>
          @elseif($item->status == 4)
          <form action="/mo/produksi/proses/{{$item->kode_mo}}" method="post">
            @method('post')
            {{ csrf_field() }}
            <button type="submit" onclick="return confirm('Sudah selesai?');" class="btn btn-info">Selesai</button>
          </form>
          @endif
          @if($item->status != 5)
          <button href="#" class="btn btn-danger">Cancel Produce</button>
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
</div>
@endsection