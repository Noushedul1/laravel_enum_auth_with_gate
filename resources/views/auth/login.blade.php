@extends('layouts.app')
@section('title','Login')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h4 class="text-center">Login</h4>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid

                    @enderror">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid

                    @enderror">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="submit" value="Login" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
