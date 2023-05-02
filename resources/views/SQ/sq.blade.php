@extends('index')
@section('content')
<div class="container-fluid">
    <div class="container-fluid mb-3">
        <a href="{{route('sqTampilMasuk')}}" class="btn btn-primary">Masukan Data</a>
    </div>
    <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Customer</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Status</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Metode Pembayaran</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($sq->count())
            @foreach($sq as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->nama_vendor}}</td>
                <td>{{$item->tanggal_transaksi}}</td>
                <td> @if($item->status == 0 )
                    <span class="badge badge-secondary" style="color: black">Masih Memesan</span>
                    @elseif($item->status == 1)
                    <span class="badge badge-primary"style="color: black">Membuat Pesanan</span>
                    @elseif($item->status == 2)
                    <span class="badge badge-warning"style="color: black">Menunggu Pembayaran</span>
                    @elseif($item->status == 3)
                    <span class="badge badge-secondary"style="color: black">Selesai</span>
                    @endif
                </td>
                <td>{{$item->total_harga}}</td>
                <td> @if($item->metode_pembayaran == 1 )
                    <span class="badge badge-primary"style="color: black">Cash</span>
                    @elseif($item->metode_pembayaran == 2)
                    <span class="badge badge-primary"style="color: black">Transfer</span>
                    @endif
                </td>
                <td>
                    @if($item->status < 2)
                    <a href="{{ url('/SQ/data/input/list/'.$item->id_sq) }}" class="btn btn-warning" role="button">Edit</a>
                    @elseif($item->status == 2)
                    <a href="{{ url('/SQ/data/list/cek/'.$item->id_sq) }}" class="btn btn-warning" role="button">Buat Pembayaran</a>
                    @endif
                    <form action="{{url('/SQ/data/hapus/'.$item->id_sq) }}" method="post">
                        @method('delete')
                        {{ csrf_field() }}
                        <button type="submit" onclick="return confirm('Yakin hapus Barang '+'{{$item->nama_produk}}?');" class="btn btn-danger delete-confirm my-1">
                            <span class="text">Delete</span>
                        </button>
                    </form>
                    <!-- <a href="" class="btn btn-danger delete-confirm" role="button">Hapus</a> -->
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