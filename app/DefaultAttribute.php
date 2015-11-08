<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefaultAttribute extends Model {
	
	use SoftDeletes;
	
	public function market()
	{
		return $this->belongsTo('App\Market');
	}
}