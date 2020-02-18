<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;




class ProfileController extends Controller
{

    public function index(){
        $profiles = Profile::withCount('followers')->orderBy('followers_count', 'desc')->get();

        $profiles = Profile::followers_list();
        return view('profile.list', compact('profiles'));
    }

	public function home(){
		$user = Auth::user();
        $follows = '';
        $home = true;
		return view('profile.show', compact('user', 'follows', 'home'));

	}

    public function indexFollow(User $user){
        $follow = $user->following;
        return view('profile.follow', compact('user','follow'));
    }

    public function indexFollowed(User $user){
        $following = $user->profile->followers;
        return view('profile.followed', compact('user', 'following'));
    }

    public function show(User $user){
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id): false;
    	return view('profile.show', compact('user', 'follows'));
    }

    public function edit(User $user){

    	$this->authorize('update', $user->profile);

    	return view('profile.edit', compact('user'));
    }

    public function update(User $user){

    	$this->authorize('update', $user->profile);

    	$data = request()->validate([
    		'name' =>'',
    		'surname' => '',
    		'bio' => '',
    		'image' => 'image']);


    	if (request('image')){
    		$imagePath = request('image')->store('profile', 'public');
    		$image = Image::make(public_path("storage/{$imagePath}"))->fit(500,500);
            $image->save();
    		$imageArr = ['image' => $imagePath ];
    	}

    	auth()->user()->profile->update(array_merge(
    		$data,
    		$imageArr ?? []
    	));

    	return redirect('/profile/'. $user->id );

    }
}
