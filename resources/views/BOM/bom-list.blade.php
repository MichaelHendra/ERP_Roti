@extends('index')
@section('content')
<div class="container-fluid mt-4">
    <div class="container-fluid mb-3">
        <a href="{{ url('/bom-input') }}" class="btn btn-primary">Masukan BOM</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Bom</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Produksi</th>
                <th scope="col">Tanggal Buat</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($boms->count())
            @foreach($boms as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->kode_bom}}</td>
                <td>{{$item->nama_produk}}</td>
                <td>{{$item->total_harga}}</td>
                <td>{{$item->tanggal}}</td>
                <td>
                    <a href="{{ url('/bom/item_list/'.$item->kode_bom) }}" class="btn btn-warning" role="button">Edit</a>
                    <a href="{{url('/bom/delete/'.$item->kode_bom)}}" class="btn btn-danger delete-confirm" role="button">Hapus</a>
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