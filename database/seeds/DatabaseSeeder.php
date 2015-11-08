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
            'views' => 10,
	    'user_id' => $oscar->id
        ]);

        $ferrari = Item::create([
            'id' => 2,
            'name' => 'Ferrari 3000',
            'description' => 'This is an add for a Ferrari 3000.',
	    'price' => 19999999,
            'by_mail' => 0,
            'views' => 1000,
	    'user_id' => $udo->id
        ]);

        $saddle = Item::create([
            'id' => 3,
            'name' => 'Brooks saddle',
            'description' => 'This is an add for a Brooks saddle.',
	    'price' => 50,
            'by_mail' => 1,
            'views' => 50,
	    'user_id' => $oscar->id
        ]);

        $tire = Item::create([
            'id' => 4,
            'name' => 'Rubber tire',
            'description' => 'This is an add for a rubber tire.',
	    'price' => 10,
            'by_mail' => 1,
            'views' => 20,
	    'user_id' => $oscar->id
        ]);

        $toyota = Item::create([
            'id' => 5,
            'name' => 'Toyota Celica',
            'description' => 'This is an add for a Japanse car.',
	    'price' => 1500,
            'by_mail' => 0,
            'views' => 150,
	    'user_id' => $udo->id
        ]);

        $chair = Item::create([
            'id' => 6,
            'name' => 'Two seat',
            'description' => 'This is an add for a leather two seater.',
	    'price' => 70,
            'by_mail' => 0,
            'views' => 35,
	    'user_id' => $udo->id
        ]);

        $banana = Item::create([
            'id' => 7,
            'name' => 'Chiquita',
            'description' => 'This is an add for a box of bananas.',
	    'price' => 5,
            'by_mail' => 1,
            'views' => 6,
	    'user_id' => $oscar->id
        ]);

        $armaniTable = Item::create([
            'id' => 8,
            'name' => 'Table',
            'description' => 'This is an add for a Armani table.',
	    'price' => 50,
            'by_mail' => 1,
            'views' => 50,
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

	ItemAttribute::create([
	    'id' => 4,
	    'name' => 'Color',
	    'value' => 'green',
	    'item_id' => $tire->id
	]);

	ItemAttribute::create([
	    'id' => 5,
	    'name' => 'Color',
	    'value' => 'yellow',
	    'item_id' => $toyota->id
	]);

	ItemAttribute::create([
	    'id' => 6,
	    'name' => 'Color',
	    'value' => 'pink',
	    'item_id' => $chair->id
	]);

	ItemAttribute::create([
	    'id' => 7,
	    'name' => 'Color',
	    'value' => 'orange',
	    'item_id' => $banana->id
	]);

	ItemAttribute::create([
	    'id' => 8,
	    'name' => 'Color',
	    'value' => 'white',
	    'item_id' => $armaniTable->id
	]);

	ItemPhoto::create([
	   'id' => 1,
	   'filename' => 'no_image.png',
	   'item_id' => $trek->id
	]);

	ItemPhoto::create([
	   'id' => 2,
	   'filename' => 'no_image.png',
	   'item_id' => $ferrari->id
	]);

	ItemPhoto::create([
	   'id' => 3,
	   'filename' => 'no_image.png',
	   'item_id' => $saddle->id
	]);

	ItemPhoto::create([
	    'id' => 4,
	    'filename' => 'no_image.png',
	    'item_id' => $tire->id
	]);

	ItemPhoto::create([
	    'id' => 5,
	    'filename' => 'no_image.png',
	    'item_id' => $toyota->id
	]);

	ItemPhoto::create([
	    'id' => 6,
	    'filename' => 'no_image.png',
	    'item_id' => $chair->id
	]);

	ItemPhoto::create([
	    'id' => 7,
	    'filename' => 'no_image.png',
	    'item_id' => $banana->id
	]);

	ItemPhoto::create([
	    'id' => 8,
	    'filename' => 'no_image.png',
	    'item_id' => $armaniTable->id
	]);


	$bikes->users()->attach($oscar->id, array('subscription' => 1, 'management' => 1));
	$cars->users()->attach($udo->id, array('subscription' => 1, 'management' => 1));
	$retro->users()->attach($oscar->id, array('subscription' => 1, 'management' => 0));
	$design->users()->attach($oscar->id, array('subscription' => 1, 'management' => 1));
	$fruit->users()->attach($udo->id, array('subscription' => 1, 'management' => 0));

	$trek->markets()->attach($bikes->id);
	$ferrari->markets()->attach($cars->id);
	$saddle->markets()->attach($bikes->id);
	$tire->markets()->attach($bikes->id);
	$toyota->markets()->attach($cars->id);
	$chair->markets()->attach($design->id);
	$banana->markets()->attach($fruit->id);
	$armaniTable->markets()->attach($design->id);
    }
}
