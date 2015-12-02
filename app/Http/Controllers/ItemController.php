<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\DefaultAttributeRequest;
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
        //Get the markets for the nav
        $markets = $this->markets;
        //Return view market/add
        return view('item.add', compact('title', 'loggedIn', 'markets'));
    }

    public function postAddItem(ItemRequest $request)
    {
        //Validate market name|description input
        $this->validate($request, [
            'name' => 'required|string|min:4|max:30',
            'description' => 'required|string|min:10|max:255',
        ]);

        //Add market
        $newMarket = new Market;
        $newMarket->name = $request['name'];
        $newMarket->description = $request['description'];
        $newMarket->save();
        
        //Attach the market to the user
        $newMarket->users()->attach(Auth::user()->id, array('subscription' => 1, 'management' => 1));
        
        //Add market's default attributes
        foreach ($request->input('defaultAttributeNames') as $name => $value)
        {
            if (!empty($value))
            {
                //Foreach attribute create record and associate to the market
                $attribute = new DefaultAttribute;
                $attribute->name = $value;
                $attribute->market()->associate($newMarket->id);
                $attribute->save();
            }
        }
        
        //If all goes successfull redirect to the newly created market
        return redirect('/m/' . $newMarket->name);
    }
}
