<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {
	
	use SoftDeletes;
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function markets()
	{
		return $this->belongsToMany('App\Market');
	}
}
