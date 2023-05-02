@extends('index')
@section('content')
<div class="container-fluid mb-3">
    <a href="/produkinput" class="btn btn-primary">Masukan Produk</a>
</div>
    <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Banyak</th>
                <th scope="col">harga Satuan</th>
                <th scope="col">Untuk</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($data->count())
            @foreach($data as $product)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td><img src="{{ url('gambar/'.$product->gambar) }}" alt="No images" style="width:150px;height:150px; border-radius: 10%;"></td>
                <td>{{$product->kode_produk}}</td>
                <td>{{$product->nama_produk}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->harga}}</td>
                <td>@if($product->status == 1)
                    Produk
                    @elseif($product->status == 2)
                    Bahan
                    @endif

                </td>
                <td><a href="{{ url('/produkedit/'.$product->kode_produk) }}" class="btn btn-warning" role="button">Edit</a>

                    <form action="/produkdelete/{{ $product->kode_produk }}" method="post">
                        @method('delete')
                        {{ csrf_field() }}
                        <button type="submit" onclick="return confirm('Yakin hapus Produk/Bahan '+'{{$product->nama_produk}}?');" class="btn btn-danger delete-confirm my-1">
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
    
@endsection