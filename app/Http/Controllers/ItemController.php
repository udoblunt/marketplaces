<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\DefaultAttributeRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\User;
use App\Item;
use App\Market;
use App\DefaultAttribute;

use Auth;
use Validator, Input, Redirect;

class ItemController extends Controller {
	
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAddItem()
    {
        //Set <title>
        $title = 'Add item';
        //Set Auth::check()
        $loggedIn = $this->loggedIn;
        //Get the markets for the nav and where to place item in
        $markets = $this->markets;
        
        //$step, used to define what to show in the view
        $step = 1;
        
        //Return view item/add
        return view('item.add', compact('title', 'loggedIn', 'markets', 'step'));
    }
    
    public function postAddItem(Request $request)
    {
        if (isset($request->next)) return $this->postAddItemStepOne($request);
        if (isset($request->save)) return $this->postAddItemStepTwo($request);
    }
    
    private function postAddItemStepOne(Request $request)
    {
        $step = 2;
        
        //Get all selected markets with the defaultAttributes
        foreach ($request->input('markets') as $marketID => $boolean)
        {
            if ($boolean) $selectedMarkets[] = Market::with('defaultAttributes')->where('id', $marketID)->get();
        }
        
        //Set <title>
        $title = 'Add item';
        //Set Auth::check()
        $loggedIn = $this->loggedIn;
        //Get the markets for the nav and where to place item in
        $markets = $this->markets;
        //Return view item/add
        return view('item.add', compact('title', 'loggedIn', 'markets', 'step', 'selectedMarkets'));
    }
    
    private function postAddItemStepTwo(ItemRequest $request)
    {
        
    }
}
