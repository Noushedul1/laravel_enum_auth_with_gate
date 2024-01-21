@extends('layouts.app')
@section('title','Post')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('post.create') }}" class="btn btn-primary my-3">Create Post</a>
                </div>
                <div class="my-3">
                    <form action="">
                        @csrf
                        <input type="text" name="post_search">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </form>
                </div>
                <div>
                    <a href="{{ route('post.trash') }}" class="btn btn-danger my-3">Go To Trash</a>
                </div>
            </div>
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
                            <a href="{{ route('post.edit',$post->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('post.show',$post->slug) }}" class="btn btn-sm btn-success">Show</a>
                            <a href="{{ route('post.destroy',$post->slug) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('postDelete{{ $post->slug }}').submit();">Trash</a>
                            <form action="{{ route('post.destroy',$post->slug) }}" method="POST" id="postDelete{{ $post->slug }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
