<?php

use App\User;
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
        $user = new User();
        $user->name = 'ipula';
        $user->email = 'ipula@gmail.com';
        $user->password = hash('sha512','123456');
        $user->role = "admin";
        $user->save();
    }
}
