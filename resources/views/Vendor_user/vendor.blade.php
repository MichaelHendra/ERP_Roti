@extends('index')
@section('content')
<div class="container-fluid mb-3">
    <a href="{{route('inputVendor')}}" class="btn btn-primary">Masukan Vendor</a>
</div>
    <table class="table table-bordered" id="myTable" name="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telpon</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
                
            </tr>
        </thead>
        <tbody>
            @if($vendors->count())
            @foreach ($vendors as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->nama_vendor}}</td>
                <td>{{$item->alamat}}</td>
                <td>{{$item->telpon}}</td>
                <td>
                    @if($item->status == 1)
                    Vendor
                    @elseif($item->status == 2)
                    User
                    @endif
                </td>
                <td>
                    <a href="{{ url('/vendor_user/edit/tampil/'.$item->id_vendor) }}" class="btn btn-warning" role="button">Edit</a>

                    <form action="{{ url('/vendor/delete/'.$item->id_vendor) }}" method="post">
                        @method('delete')
                        {{ csrf_field() }}
                        <button type="submit" onclick="return confirm('Anda Menghapus Vendor/User '+'?');" class="btn btn-danger delete-confirm my-1">
                            <span class="text">Delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
           @endif
        </tbody>
    </table>
    
@endsection