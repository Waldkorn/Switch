<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class userFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\User::class, 50)->create()->each(function ($u) {
	        $u->chatmessages()->save(factory(App\Chatmessage::class)->make());
    	});

    	foreach(App\User::all() as $user) 
    	{

    		DB::table('streams')->insert([
    			'user_id' => $user->id,
    			'game_id' => '2',
    			'title' => 'I am streaming minecraft!'
    		]);

    	}

	    foreach(App\User::all() as $user)
        {
        	for ($i = 0 ; $i < 5 ; $i++)
        	{
	            DB::table('followers')->insert([
	            	'follower_id' => $user->id,
	            	'streamer_id' => random_int(1, 50)
	            ]);
	   		}
        }
    }
}
