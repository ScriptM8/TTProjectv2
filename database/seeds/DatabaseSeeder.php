<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
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
