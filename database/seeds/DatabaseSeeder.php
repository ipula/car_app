<?php

use App\Supplier;
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
//        $user = new User();
//        $user->name = 'ipula';
//        $user->email = 'ipula@gmail.com';
//        $user->password = hash('sha512','123');
//        $user->role = "admin";
//        $user->save();

        $user = new Supplier();
        $user->supplier_name = 'Common Supplier';
        $user->supplier_tel_no = '0716713794';
        $user->supplier_code = 'S001';
        $user->supplier_cust_code = 1;
        $user->save();
    }
}
