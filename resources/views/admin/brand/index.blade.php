@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Merek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Merek</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Merek</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Merek</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td> <img src="{{asset($brand->path_image)}}" alt="image" width="50px" height="50px"> </td>
                                            <td>{{$brand->brand}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-ubah-{{$loop->iteration}}">Ubah</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus-{{$loop->iteration}}">Hapus</button>
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

@foreach ($brands as $brand)
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-ubah-{{$loop->iteration}}" aria-labelledby="modal-ubah" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{route('brands.update', ['brand' => $brand->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Merek</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Merek</label> <small class="text-danger">*</small>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{$brand->brand}}" required>
                            @error('brand')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Upload Foto Merek</label>
                            <input type="file" class="form-control @error('picturePath') is-invalid @enderror" name="picturePath">
                            @error('picturePath')
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus-{{$loop->iteration}}" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Merek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menghapus merek {{$brand->brand}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="{{route('brands.destroy', ['brand' => $brand->id])}}" class="btn btn-danger">Ya</a>
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