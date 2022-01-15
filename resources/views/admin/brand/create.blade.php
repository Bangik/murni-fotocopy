@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Merek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('brands.index')}}">Merek</a></div>
                <div class="breadcrumb-item">Tambah Merek</div>
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
                            <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Merek</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required autofocus>
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
@endsection