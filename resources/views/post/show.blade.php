@extends('layouts.app')
@section('title','Post Show')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $post->name }}</h4>
                </div>
                <img src="{{ asset('post_images/'.$post->image) }}" alt="" class="card-img-top">
            </div>
        </div>
    </div>
</div>
@endsection
