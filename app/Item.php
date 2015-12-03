<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {
	
	use SoftDeletes;
        
        protected $fillable = ['name', 'description'];
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function markets()
	{
		return $this->belongsToMany('App\Market');
	}

	public function itemAttributes()
	{
		return $this->hasMany('App\ItemAttribute','item_id','id');
	}

	public function itemPhotos()
	{
		return $this->hasMany('App\ItemPhoto','item_id','id');
	}
}
