<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\User;
use App\Item;
use App\Market;
use App\MarketVote;

use Auth;
use Validator, Input, Redirect;

class EnvironmentController extends Controller {
	
	public function __construct() {
            parent::__construct();
        }

	public function getIndex ()
	{
		$loggedIn = $this->loggedIn;
		$title = 'index';

		$markets = $this->markets;

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

	public function getMarket($market)
	{
		$loggedIn = $this->loggedIn;

		$title = $market;

		$detailMarket = Market::where('name', $market)->first();

		$items = $detailMarket->items()->orderBy('views', 'desc')->get();

		foreach ($items as $item) {
			$users[$item->id] = $item->user;
		}

		$markets = $this->markets;

		return view('environment.market', compact('title', 'items', 'detailMarket', 'markets', 'users', 'loggedIn'));
	}

	public function getItem($market, $item)
	{
		$loggedIn = $this->loggedIn;

		$title = $market . ' - ' . $item;

		$marketName = $market;
		
		$item = Item::where('name', $item)->first();

		$user = $item->user;

		$markets = $this->markets;

		return view('environment.item', compact('title', 'markets', 'item', 'user', 'marketName', 'loggedIn'));
	}

	public function getMarketVote($market, $math)
	{
		$market = Market::where('name', $market)->first();
		$user = Auth::user();

		$userVotes = MarketVote::where('user_id', $user->id)->get();

		if ($userVotes != null) {
			foreach ($userVotes as $userVote) {
				if ($userVote->market_id == $market->id) {
					return back();
				}
			}
		}

		$vote = new MarketVote;

		$vote->user()->associate($user);
		$vote->market()->associate($market);

		$vote->save();

		if ($math == 'up') {
			$market->upvote = $market->upvote + 1;
		} else {
			$market->upvote = $market->upvote - 1;
		}
		

		$market->save();

		return back();
	}
}
