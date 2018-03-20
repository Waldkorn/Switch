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
                    'image_source' => '/images/games/minecraft.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Dota2',
                    'description' => 'two teams of five players compete to collectively destroy a large structure defended by the opposing team known as the "Ancient", whilst defending their own.',
                    'image_source' => '/images/games/dota2.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Creative',
                    'description' => 'For creative folks',
                    'image_source' => '/images/games/creative.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Overwatch',
                    'description' => 'Choose your hero and clash on the battle fields of tomorrow. Bend time, defy physics, and wield extraordinary powers in the ultimate team-based shooter.',
                    'image_source' => '/images/games/overwatch.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Programming',
                    'description' => 'Just us testing!',
                    'image_source' => '/images/games/programming.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'World of Warcraft',
                    'description' => 'an online role-playing experience set in the award-winning Warcraft universe.',
                    'image_source' => '/images/games/wow.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => "Player Unknown's Battlegrounds",
                    'description' => 'a last-man-standing shooter being developed with community feedback. Players must fight to locate weapons and supplies in a massive 8x8 km island to be the lone survivor. This is BATTLE ROYALE.',
                    'image_source' => '/images/games/pubg.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
    }
}
