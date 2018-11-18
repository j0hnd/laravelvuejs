<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Member;

class LinkMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:link-members-to-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link members to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get()->each(function ($user) {
            if ($user->member == null) {
                $this->info('Linking user ' . $user->name);
                $user->member()->save(new Member(['alias' => $user->name, 'is_private' => 1]));
            }
        });
    }
}
