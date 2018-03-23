<?php

use Illuminate\Database\Seeder;

class ProfilecontentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('profilecontents')->insert([

                [
                    'user_id' => '1',
                  	'about' => 'Hello, I am a streamer!',
              			'img_url' => '/images/placeholder.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '2',
                    'about' => 'Hello, I am a tester!',
              			'img_url' => '/images/placeholder.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '3',
                    'about' => 'Hello, I am a viewer!',
                    'img_url' => '/images/placeholder.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
    }
}
