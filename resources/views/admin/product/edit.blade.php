@extends('layouts.admin.app')

@section('css-admin')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('products.index')}}">Produk</a></div>
                <div class="breadcrumb-item">Edit Produk</div>
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
                            <form action="{{route('products.update', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Kategori Produk</label> <small class="text-danger">*</small> <small> <a href="" data-toggle="modal" data-target="#modal-category">Tambah Kategori</a> </small>
                                    <select class="form-control select2 @error('category') is-invalid @enderror" name="category" id="category">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if ($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Merek Produk</label> <small class="text-danger">*</small> <small> <a href="" data-toggle="modal" data-target="#modal-brand">Tambah Merek</a> </small>
                                    <select class="form-control select2 @error('brand') is-invalid @enderror" name="brand" id="brand">
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" @if ($brand->id == $product->brand_id) selected @endif>{{$brand->brand}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label> <small class="text-danger">*</small>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ $product->barcode }}">
                                    @error('barcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label> <small class="text-danger">*</small>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Kulak</label>
                                    <input type="number" class="form-control @error('capitalPrice') is-invalid @enderror" name="capitalPrice" value="{{ $product->capital_price }}">
                                    @error('capitalPrice')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $product->stock }}">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Minimal Stok</label>
                                    <input type="number" class="form-control @error('minStock') is-invalid @enderror" name="minStock" value="{{ $product->min_stock }}">
                                    @error('minStock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Satuan Produk</label> <small class="text-danger">*</small> <small> <a href="" data-toggle="modal" data-target="#modal-unit">Tambah Satuan</a> </small>
                                    <select class="form-control select2 @error('unit') is-invalid @enderror" name="unit" id="unit">
                                        @foreach ($units as $unit)
                                        <option value="{{$unit->id}}" @if ($unit->id == $product->unit_id) selected @endif>{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Upload Foto Produk</label>
                                    <input type="file" class="form-control @error('picturePath') is-invalid @enderror" name="picturePath">
                                    @error('picturePath')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-category" aria-labelledby="modal-category" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-category">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label> <small class="text-danger">*</small>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-brand" aria-labelledby="modal-brand" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-brand">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Merek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Merek</label> <small class="text-danger">*</small>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-unit" aria-labelledby="modal-unit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-unit">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Satuan</label> <small class="text-danger">*</small>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js-admin')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').select2({
            theme: "bootstrap"
        });

        $('#form-category').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('categories.storeAjax')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $('#modal-category').modal('hide');
                    $('#category').append(`<option value="${data.id}">${data.name}</option>`);
                    $('#category').val(data.id).trigger('change');
                }
            });
        });

        $('#form-brand').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('brands.storeAjax')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $('#modal-brand').modal('hide');
                    $('#brand').append(`<option value="${data.id}">${data.brand}</option>`);
                    $('#brand').val(data.id).trigger('change');
                }
            });
        });

        $('#form-unit').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('units.storeAjax')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $('#modal-unit').modal('hide');
                    $('#unit').append(`<option value="${data.id}">${data.name}</option>`);
                    $('#unit').val(data.id).trigger('change');
                }
            });
        });
    });
</script>
@endsection