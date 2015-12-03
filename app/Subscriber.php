<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model {

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function market()
	{
		return $this->belongsTo('App\Market');
	}
}
