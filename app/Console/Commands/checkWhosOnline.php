<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Stream;

class checkWhosOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $streams = Stream::where('now_live', TRUE)->get();
        $users = User::where('now_live', TRUE)->get();

        foreach ($users as $user) {
            $user->update([
                'now_live' => FALSE
            ]);
        }

        foreach ($streams as $stream) {
            $stream->update([
                'now_live' => FALSE
            ]);
        }

        User::where('id', 1)->update([
            'name' => 'testje'
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        // Stream::where('now_live', TRUE)->update([
        //     'now_live'=> FALSE
        // ]);

        // User::where('now_live', TRUE)->update([
        //     'now_live' => FALSE
        // ]);
    }
}
