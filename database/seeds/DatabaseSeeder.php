<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Market;
use App\DefaultAttribute;
use App\Item;
use App\ItemAttribute;
use App\ItemPhoto;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MarketplacesAppSeeder::class);

        Model::reguard();
    }
}

class MarketplacesAppSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();
        DB::table('markets')->delete();
        DB::table('default_attributes')->delete();
        DB::table('items')->delete();
        DB::table('item_attributes')->delete();
        DB::table('item_photos')->delete();

        $oscar = User::create([
            'id' => 1,
            'firstname' => 'Oscar',
            'lastname' => 'van Ruiten',
            'email' => 'oscar@marketplace.com',
            'password' => bcrypt('secret'),
            'country' => 'The Netherlands',
            'state' => 'South-Holland',
            'postal_code' => '3000',
            'phone' => '0479671567'
        ]);

	$udo = User::create([
            'id' => 2,
            'firstname' => 'Steven',
            'lastname' => 'Grauwmans',
            'email' => 'steven@marketplace.com',
            'password' => bcrypt('secret'),
            'country' => 'Belgium',
            'state' => 'Antwerp',
            'postal_code' => '2323',
            'phone' => '0479343719'
        ]);  

        $bikes = Market::create([
            'id' => 1,
            'name' => 'Bikes',
            'description' => 'Market for bikes.'
        ]);

        $cars = Market::create([
            'id' => 2,
            'name' => 'Cars',
            'description' => 'Market for cars.'
        ]);

        $retro = Market::create([
            'id' => 3,
            'name' => 'Retro',
            'description' => 'Market for retro stuff.'
        ]);

        $design = Market::create([
            'id' => 4,
            'name' => 'Designer furniture',
            'description' => 'Market for expensive sheeeeeet.'
        ]);

        $fruit = Market::create([
            'id' => 5,
            'name' => 'Fruit',
            'description' => 'Market for fresh bananas.'
        ]);

        DefaultAttribute::create([
            'id' => 1,
            'name' => 'Color',
            'market_id' => $bikes->id
        ]);

	DefaultAttribute::create([
            'id' => 2,
            'name' => 'Frame size',
            'market_id' => $bikes->id
        ]);

	DefaultAttribute::create([
            'id' => 3,
            'name' => 'Brand',
            'market_id' => $cars->id
        ]);

	$trek = Item::create([
            'id' => 1,
            'name' => 'Trek Bike',
            'description' => 'This is an add for a Trek Bike.',
	    'price' => 500,
            'by_mail' => 0,
	    'user_id' => $oscar->id
        ]);

        $ferrari = Item::create([
            'id' => 2,
            'name' => 'Ferrari 3000',
            'description' => 'This is an add for a Ferrari 3000.',
	    'price' => 19999999,
            'by_mail' => 0,
	    'user_id' => $udo->id
        ]);

        $saddle = Item::create([
            'id' => 3,
            'name' => 'Brooks saddle',
            'description' => 'This is an add for a Brooks saddle.',
	    'price' => 50,
            'by_mail' => 1,
	    'user_id' => $oscar->id
        ]);

	ItemAttribute::create([
	    'id' => 1,
	    'name' => 'Color',
	    'value' => 'black',
	    'item_id' => $trek->id
	]);

	ItemAttribute::create([
	    'id' => 2,
	    'name' => 'Brand',
	    'value' => 'Ferrari',
	    'item_id' => $ferrari->id
	]);

	ItemAttribute::create([
	    'id' => 3,
	    'name' => 'Frame size',
	    'value' => '58',
	    'item_id' => $saddle->id
	]);

	ItemPhoto::create([
	   'id' => 1,
	   'filename' => 'test.png',
	   'item_id' => $trek->id
	]);

	ItemPhoto::create([
	   'id' => 2,
	   'filename' => 'test.png',
	   'item_id' => $ferrari->id
	]);

	ItemPhoto::create([
	   'id' => 3,
	   'filename' => 'test.png',
	   'item_id' => $saddle->id
	]);


	$bikes->users()->attach($oscar->id, array('subscription' => 1, 'management' => 1));
	$cars->users()->attach($udo->id, array('subscription' => 1, 'management' => 1));
	$retro->users()->attach($oscar->id, array('subscription' => 1, 'management' => 0));
	$design->users()->attach($oscar->id, array('subscription' => 1, 'management' => 1));
	$fruit->users()->attach($udo->id, array('subscription' => 1, 'management' => 0));

	$trek->markets()->attach($bikes->id);
	$ferrari->markets()->attach($cars->id);
	$saddle->markets()->attach($bikes->id);
    }
}
