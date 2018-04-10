<?php

use Illuminate\Database\Seeder;

class StreamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('streams')->insert([

                [
                    'user_id' => '1',
                    'game_id' => '2',
                    'title' => 'stream',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '2',
                    'game_id' => '2',
                    'title' => 'stream',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '3',
                    'game_id' => '2',
                    'title' => 'stream',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => '4',
                    'game_id' => '5',
                    'title' => 'stream',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
    }
}
