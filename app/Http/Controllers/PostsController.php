<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use App\Posts;


class PostsController extends Controller
{

	// public function __construct(){
	// 	$this->middleware('auth');
	// }
	
    public function create(){
    	return view('posts.create');
    }

    public function store(){
    	$data = request()->validate([
    		'title' => 'required|min:3',
    		'text' => 'required|min:10',
    		'image' => 'required|image',
    	]);
    	$imagePath = request('image')->store('posts', 'public');
		$image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
        $image->save();
    	auth()->user()->posts()->create(array_merge(
    		$data,
    		['image' => $imagePath]
    	));

        return redirect('/home/');
    }

    public function show(Posts $post){
    	return view('posts.show', compact('post'));
    } 

    public function destroy(Posts $post){

        $this->authorize('update', $post->user->profile);

        $post->delete();
        return redirect('/profile/' . $post->user->id);
    }
}
