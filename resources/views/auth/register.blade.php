@extends('layouts.app')
@section('title','Register')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <h4 class="text-center">Registration</h4>
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid

                    @enderror">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
                    <label for="" class="form-label">Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid

                    @enderror">
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
