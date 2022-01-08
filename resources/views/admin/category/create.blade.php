@extends('layouts.admin.app')

@section('content-admin')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kategori</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{route('categories.index')}}">Kategori</a></div>
                <div class="breadcrumb-item">Tambah Kategori</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Upload Foto Kategori</label>
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