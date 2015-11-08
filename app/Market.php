<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model {
	
	use SoftDeletes;
	
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}