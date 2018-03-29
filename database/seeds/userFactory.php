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
    public function run(Faker $faker)
    {
    	factory(App\User::class, 100)->create()->each(function ($u) {
	        $u->chatmessages()->save(factory(App\Chatmessage::class)->make());
          $u->stream()->save(factory(App\Stream::class)->make());
    	});

    	foreach(App\User::all() as $user)
    	{

        // $user->stream()->save(factory(App\Stream::class)->make());
    		// DB::table('streams')->insert([
    		// 	'user_id' => $user->id,
    		// 	'game_id' => random_int(1,7),
    		// 	'title' => $faker->sentence($nbWords = 6),
      //     'created_at' => date('Y-m-d H:i:s'),
      //     'updated_at' => date('Y-m-d H:i:s'),
    		// ]);

        DB::table('profilecontents')->insert([
    			'user_id' => $user->id,
    			'about' => 'Hello I am a bot!',
    			'img_url' => '/images/' . random_int(1,6) . '.png',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
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
