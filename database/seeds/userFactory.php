<?php

use Illuminate\Database\Seeder;

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
    }
}
