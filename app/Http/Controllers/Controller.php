<?php

namespace App\Http\Controllers;

use Auth;
use App\Market;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $loggedIn = false;
    protected $markets;
        
    public function __construct() {
        $this->loggedIn = Auth::check();
    	$this->markets = Market::orderBy('upvote', 'desc')->get();;
    }
}
