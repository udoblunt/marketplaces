<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefaultAttribute extends Model {
	
        protected $fillable = ['name', 'description'];
        
	public function market()
	{
		return $this->belongsTo('App\Market');
	}
}