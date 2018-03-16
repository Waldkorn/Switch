<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(GamesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StreamsTableSeeder::class);

    }
}
