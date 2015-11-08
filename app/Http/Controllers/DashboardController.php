<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\User;
use App\Item;
use App\Market;

use Auth;
use Validator, Input, Redirect;

class DashboardController extends Controller {
	public function getIndex ()
	{
		$title = 'dashboard';

		$markets = Market::all();

		return view('dashboard.home', compact('title', 'markets'));
	}
}
