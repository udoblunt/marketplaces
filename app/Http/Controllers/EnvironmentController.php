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
use App\Subscriber;

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

		$subscriptions = Subscriber::where('user_id', Auth::user()->id)->get();

		foreach ($subscriptions as $subscription) {
			$userSubscriptions[$subscription->market_id] = Market::where('id', $subscription->market_id)->first();
		}
		
		foreach ($markets as $market) {
		      $items[$market->id] = $market->items()->orderBy('views', 'desc')->take(2)->get();			
		}

		foreach ($items as $itemsSet) {
		      foreach ($itemsSet as $item) {
		            $users[$item->id] = $item->user;
		      }
		}

		return view('environment.home', compact('title', 'items', 'markets', 'users', 'loggedIn', 'userSubscriptions'));
	}

	public function getMarket($market)
	{
		$loggedIn = $this->loggedIn;

		$title = $market;

		$detailMarket = Market::where('name', $market)->first();

		$userSubscription = Subscriber::where(array('user_id' => Auth::user()->id, 'market_id' => $detailMarket->id))->first();

		$items = $detailMarket->items()->orderBy('views', 'desc')->get();

		foreach ($items as $item) {
			$users[$item->id] = $item->user;
		}

		$markets = $this->markets;

		return view('environment.market', compact('title', 'items', 'detailMarket', 'markets', 'users', 'loggedIn', 'userSubscription'));
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

	public function getMarketSubscribe($market)
	{
		$market = Market::where('name', $market)->first();

		$user = Auth::user();

		$subscriber = Subscriber::where(array('user_id' => $user->id, 'market_id' => $market->id))->first();

		if ($subscriber != null) {

			$subscriber->delete();

		} else {

			$subscriber = new Subscriber;

			$subscriber->user()->associate($user);
			$subscriber->market()->associate($market);

			$subscriber->save();
		}

		return back();
	}

	public function getExplore() 
	{
		$loggedIn = $this->loggedIn;
		$title = 'index';

		$markets = $this->markets;

		$subscriptions = Subscriber::where('user_id', Auth::user()->id)->get();

		foreach ($subscriptions as $subscription) {
			$userSubscriptions[$subscription->market_id] = Market::where('id', $subscription->market_id)->first();
		}
		
		foreach ($markets as $market) {
		      $items[$market->id] = $market->items()->orderBy('views', 'desc')->take(2)->get();			
		}

		foreach ($items as $itemsSet) {
		      foreach ($itemsSet as $item) {
		            $users[$item->id] = $item->user;
		      }
		}

		return view('environment.explore', compact('title', 'items', 'markets', 'users', 'loggedIn', 'userSubscriptions'));
	}
}
