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
                    'name' => 'Dota2',
                    'description' => 'two teams of five players compete to collectively destroy a large structure defended by the opposing team known as the "Ancient", whilst defending their own.',
                    'image_source' => 'https://1.bp.blogspot.com/-GplgZlvkXSc/Uk_3BipvAlI/AAAAAAAAAJE/NIU9Sm2vSVU/s1600/Dota2-Filled.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Creative',
                    'description' => 'For creative folks',
                    'image_source' => 'http://cdn.sheknows.com/articles/2013/04/arts-and-crafts-table.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Overwatch',
                    'description' => 'Choose your hero and clash on the battle fields of tomorrow. Bend time, defy physics, and wield extraordinary powers in the ultimate team-based shooter.',
                    'image_source' => 'http://www.stickpng.com/assets/images/586273b931349e0568ad89df.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Programming',
                    'description' => 'Just us testing!',
                    'image_source' => 'https://i.pinimg.com/736x/1b/49/8f/1b498f688d3c3ed2d89d405ea7313696--programmer-humor-ruby-rails.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'World of Warcraft',
                    'description' => 'an online role-playing experience set in the award-winning Warcraft universe.',
                    'image_source' => 'https://seeklogo.com/images/W/world-of-warcraft-logo-B9B6FAA0CB-seeklogo.com.jpg',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => "Player Unknown's Battlegrounds",
                    'description' => 'a last-man-standing shooter being developed with community feedback. Players must fight to locate weapons and supplies in a massive 8x8 km island to be the lone survivor. This is BATTLE ROYALE.',
                    'image_source' => 'https://orig00.deviantart.net/f610/f/2017/333/4/9/playerunknown_s_battlegrounds_by_jihadghazi-dbv8v6m.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
    }
}
