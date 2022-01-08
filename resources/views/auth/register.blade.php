@extends('layouts.auth.app')

@section('content-auth')

<div class="card card-primary">
    <div class="card-header">
        <h4>Daftar</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Nomor HP</label>
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="d-block">Password</label>
                <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" name="password" data-indicator="pwindicator" required>
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password2" class="d-block">Konfirmasi Password</label>
                <input id="password2" type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js-lib-auth')
<script src="{{asset('assets/js/jquery.pwstrength.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.selectric.min.js')}}"></script>
@endsection

@section('js-page-auth')
<script src="{{asset('assets/js/page/auth-register.js')}}"></script>
@endsection