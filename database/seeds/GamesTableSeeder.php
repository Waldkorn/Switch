<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('games')->insert([

                [
                    'name' => 'Minecraft',
                    'description' => 'Minecraft is a game about placing blocks and going on adventures.',
                    'image_source' => 'https://is5-ssl.mzstatic.com/image/thumb/Purple128/v4/f4/0f/0e/f40f0e76-f816-f150-c0ea-55a9a024b3d2/mzl.fmipqnrh.png/246x0w.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => '',
                    'description' => '',
                    'image_source' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
    }
}
