<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\User;
use App\Item;

use Auth;
use Validator, Input, Redirect;

class PublicController extends Controller {
	public function getIndex ()
	{
		$title = 'index';

		$items = Item::all();

		return view('public.home', compact('title', 'items'));
	}
}
