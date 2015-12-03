<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model {
	
	use SoftDeletes;
        
        protected $fillable = ['name'];
	
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
        
        public function marketVotes()
        {
            return $this->hasMany('App\MarketVote', 'market_id', 'id');
        }

    public function subscribers()
    {
        return $this->hasMany('App\Subscriber','user_id','id');
}

    public function managers()
    {
        return $this->hasMany('App\Manager','user_id','id');
    }
}
