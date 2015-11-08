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

class PublicController extends Controller {
	public function getIndex ()
	{
		$title = 'index';

		$items = Item::all();
		$markets = Market::all();

		return view('public.home', compact('title', 'items', 'markets'));
	}
}
