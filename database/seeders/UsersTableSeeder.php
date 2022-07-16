<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount=max((int)$this->command->ask('How many users would you like?',20),1);
        \App\Models\User::factory()->state(["name"=>'fatih-ates','is_admin'=>true,'email'=>'fatih@fatih.com'])->create();
        \App\Models\User::factory($usersCount)->create();
    }
}
// \App\Models\User::factory()->state('fatih-ates')->create;