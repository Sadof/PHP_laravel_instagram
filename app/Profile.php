<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Profile extends Model
{
   protected $guarded = [];

	public function getImage(){
		$path = $this->image ?? 'profile/default.png';
		return 	'/storage/'. $path;
	}

	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function followers(){
		return $this->belongsToMany(User::class);
	}
}
