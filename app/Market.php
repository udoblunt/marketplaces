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

	public function defaultAttributes()
	{
		return $this->hasMany('App\DefaultAttribute','market_id','id');
	}

	public function items()
	{
		return $this->belongsToMany('App\Item');
	}
}
