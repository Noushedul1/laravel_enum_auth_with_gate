@extends('layouts.app')
@section('title','Post trash')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <a href="{{ route('post.index') }}" class="btn btn-danger my-3">Go To Post</a>
            <table class="table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            <img src="{{ asset('post_images/'.$post->image) }}" alt="" height="50" width="50">
                        </td>
                        <td>
                            <a href="{{ route('post.restore',$post->slug) }}" class="btn btn-sm btn-primary">Restore</a>
                            <a href="{{ route('post.forceDelete',$post->slug) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('postForceDelete{{ $post->slug }}').submit();">Force Delete</a>
                            <form action="{{ route('post.forceDelete',$post->slug) }}" method="POST" id="postForceDelete{{ $post->slug }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
