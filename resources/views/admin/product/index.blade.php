@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Produk</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Kategori</th>
                                            <th>Merek</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Jual</th>
                                            <th>Harga Kulak</th>
                                            <th>Stok</th>
                                            <th>Min Stok</th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td> <img src="{{asset($product->path_image)}}" alt="image" width="50px" height="50px"> </td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->brand->brand}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->capital_price}}</td>
                                            <td>{{$product->stock}}</td>
                                            <td>{{$product->min_stock}}</td>
                                            <td>{{$product->unit->name}}</td>
                                            <td>
                                                <a href="{{route('products.edit', ['id' => $product->id])}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus-{{$loop->iteration}}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach ($products as $product)
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus-{{$loop->iteration}}" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menghapus merek {{$product->product}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="{{route('products.delete', ['id' => $product->id])}}" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
@section('js-admin')
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
@endsection