@extends('layouts.app')

@section('title', 'Login - Digital Library')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h4 class="mb-3">Login</h4>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button class="btn btn-primary w-100">Masuk</button>
            </form>
            <p class="mt-3 mb-0 text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </div>
    </div>
</div>
@endsection
