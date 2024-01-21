<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Events\UserInformation;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostdeleteNotification;

class PostController extends Controller
{
    public function index() {
        $posts = Post::paginate(5);
        return view('post.post',compact('posts'));
    }
    public function create() {
        if(Gate::none(['isSuperadmin','isEditor'],auth()->user())) {
            return view('post.create');
        }else{
            abort(403);
        }
    }
    public function store(PostRequest $request) {
        $request->validated();
        $post = new Post();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $manager = new ImageManager(new Driver());
            $extension = $file->getClientOriginalExtension();
            $filenameToStore = rand().'.'.$extension;
            $img = $manager->read($file);
            // $img->scale(200, 100); // image quality damage
            $img->resize(300, 300);
            $img->toJpeg(80)->save('post_images/'.$filenameToStore);
            // $file->move('post_images/',$filenameToStore);
        }
        $post->name = $request->name;
        $post->slug = Str::slug($request->name);
        $post->image = $filenameToStore;
        $post->save();
        $userInfo = ['name'=>$request->name];

        event(new UserInformation($userInfo));
        return to_route('post.index');
    }
    public function edit($slug) {
        $post = Post::where('slug',$slug)->first();
        return view('post.edit',compact('post'));
    }
    public function show($slug) {
        $post = Post::where('slug',$slug)->first();
        return view('post.show',compact('post'));
    }
    public function update(Request $request,$slug) {
        $post = Post::where('slug',$slug)->first();
        if($request->hasFile('image')) {
            if(File::exists('post_images/'.$post->image)) {
                File::delete('post_images/'.$post->image);
            }
        }
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filenameToStore = rand().'.'.$extension;
            $file->move('post_images/',$filenameToStore);
            $post->image = $filenameToStore;
        }
        $post->name = $request->name;
        $post->slug = Str::slug($request->slug);
        $post->save();
        return to_route('post.index');
    }
        public function destroy($slug) {
        $post = Post::where('slug',$slug)->first();
        // if(File::exists('post_images/'.$post->image)) {
            //     File::delete('post_images/'.$post->image);
            // }
            $post->delete();
            return to_route('post.index');
        }
        //trash
        public function trash() {
            $posts = Post::onlyTrashed()->get();
            return view('post.post-trash',compact('posts'));
        }
        public function restore($slug) {
            $post = Post::withTrashed()->where('slug',$slug)->first();
            $post->restore();
            return to_route('post.index');
        }
        public function forceDelete($slug) {
            $post = Post::withTrashed()->where('slug',$slug)->first();
            if(File::exists('post_images/'.$post->image)) {
                File::delete('post_images/'.$post->image);
            }
            $post->forceDelete();
            $users = User::all();
            $deletedPost = ['name'=>$post->name,'slug'=>$post->slug];
            foreach($users as $user) {
                Notification::send($user,new PostdeleteNotification($deletedPost));
            }
            return to_route('post.trash');
        }
    }
