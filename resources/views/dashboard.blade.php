@extends('layouts.app')
@section('title','Dashboard')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            @auth()

            @if (Route::has('logout'))
            <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('adminLogout').submit();">Logout</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" id="adminLogout">
                @csrf
            </form>

            @if (Route::has('post.index'))
            <a href="{{ route('post.index') }}">Post</a>
            @endif
            @else
            <ul>
                <li>
                    <a href="{{ route('create') }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Register</a>
                </li>
            </ul>
            @endauth
            <h1 class="text-center">Welcome to Dashboard {{ Auth::user()->name }}</h1>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed enim similique debitis porro id minima eveniet voluptatum nisi, eum rem nulla accusamus odio natus assumenda reprehenderit earum doloribus pariatur sequi?
            @can('isSuperadmin')
            <h2>Hello super admin</h2>
            @endcan
            @can('isManager')
                <h2>manager</h2>
            @endcan
            @can('isEditor')
            <h2>Editor</h2>
            @endcan
        </div>
    </div>
</div>
@endsection
