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

class MarketController extends Controller {
	
	public function __construct()
    	{
        	
    	}
        
        /*
         * NEEDS TO BE UPDATED
         */
	/*public function getMarket($market)
	{
		$loggedIn = $this->loggedIn;

		$title = $market;

		$markets = Market::orderBy('upvote', 'desc')->get();

		$detailMarket = Market::where('name', $market)->first();

		$items = $detailMarket->items()->orderBy('views', 'desc')->get();

		foreach ($items as $item) {
			$users[$item->id] = $item->user;
		}

		return view('environment.market', compact('title', 'items', 'detailMarket', 'markets', 'users', 'loggedIn'));
	}*/
        
        public function getAddMarket()
        {
            //Set <title>
            $title = 'Add market';
            //Return view market/add
            return view('market.add', compact('title'));
        }
        
        public function postAddMarket(Request $request)
        {
            //Validate market name|description input
            $this->validate($request, [
                'name' => 'required|string|min:4|max:30',
                'description' => 'required|string|min:10|max:255'
            ]);
            //Add market
            $newMarket = Market::create([
                'name' => $request['name'],
                'description' => $request['description']
            ]);
            //Attach the market to the user
            $newMarket->users()->attach(Auth::user()->id);
            //Validate market's default attributes
            //echo '<pre>';;echo '</pre>';
            //Add market's default attributes
            
            //If all goes successfull redirect to the newly created market
            //return redirect('/m/' . $marketID);
        }
}
