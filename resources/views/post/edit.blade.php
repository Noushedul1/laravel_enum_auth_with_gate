@extends('layouts.app')
@section('title','Post Create')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h1 class="text-center">Post Create</h1>
            <form action="{{ route('post.update',$post->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $post->name }}" class="form-control">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset('post_images/'.$post->image) }}" alt="" height="100" width="100">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Post update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
