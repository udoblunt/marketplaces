<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\User;

use Auth;
use Validator, Input, Redirect;

class UserController extends Controller {

	public function getIndex ()
	{
		$loggedIn = $this->loggedIn;
		$title = 'index';
		$markets = Market::orderBy('upvote', 'desc')->get();

		foreach ($markets as $market) {
		      $items[$market->id] = $market->items()->orderBy('views', 'desc')->take(2)->get();			
		}

		foreach ($items as $itemsSet) {
		      foreach ($itemsSet as $item) {
		            $users[$item->id] = $item->user;
		      }
		}

		return view('environment.home', compact('title', 'items', 'markets', 'users', 'loggedIn'));
	}

	protected function DistanceBetween($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);

		$lonDelta = $lonTo - $lonFrom;
		$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
		$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

		$angle = atan2(sqrt($a), $b);
		
		return $angle * $earthRadius;
	}
}
