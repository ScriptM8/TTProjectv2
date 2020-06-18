<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $admin = new User();
        $admin->name = 'administrator';
        $admin->email = 'admin@haltura.lv';
        $admin->password = bcrypt('secret');
        $admin->role = 1;
        $admin->save();

        $user = new User();
        $user->name = 'Jurka';
        $user->email = 'jurka@gmail.com';
        $user->password = bcrypt('jurka');
        $user->role = 0;
        $user->save();

    }
}
