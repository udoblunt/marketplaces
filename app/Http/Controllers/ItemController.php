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
use App\ItemAttribute;
use App\ItemPhoto;

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
    
    public function postAddItem(ItemRequest $request)
    {
        //Check if atleast one market has been selected
        if (isset($request->next))
        {
            //If no markets were selected go back to the previous page
            if (empty($request->markets)) return back();
            
            //Return the next step if all went well
            return $this->postAddItemStepOne($request);
        }
        
        
        if (isset($request->save)) return $this->postAddItemStepTwo($request);
    }
    
    private function postAddItemStepOne(ItemRequest $request)
    {
        $step = 2;
        
        //Get all selected markets with the defaultAttributes
        foreach ($request->input('markets') as $marketID => $boolean)
        {
            if ($boolean) $selectedMarkets[] = Market::with('defaultAttributes')->where('id', $marketID)->first();
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
        //Create new item
        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->by_mail = ($request->by_mail) ? 1 : 0;
        $item->user()->associate(Auth::user());
        $item->save();
        
        //Create new itemAttributes based on the defaultAttributes of the market
        foreach ($request->itemAttributes as $name => $value)
        {
            $itemAttribute = new ItemAttribute;
            $itemAttribute->name = $name;
            $itemAttribute->value = $value;
            $itemAttribute->item()->associate($item);
            $itemAttribute->save();
        }
        
        //Create new itemPhotos
        /*if (!empty($request->itemPhotos))
        {
            foreach ($request->get('itemPhotos') as $itemPhoto)
            {
                var_dump($itemPhoto);exit;
            }
        }*/
    }
}
