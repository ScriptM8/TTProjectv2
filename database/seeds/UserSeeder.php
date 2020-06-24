<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();

        $admin = new User();
        $admin->name = 'administrator';
        $admin->email = 'admin@haltura.lv';
        $admin->password = bcrypt('secret');
        $admin->role = 1;
        $admin->save();

        $jurka = new User();
        $jurka->name = 'Jurka';
        $jurka->email = 'jurka@gmail.com';
        $jurka->password = bcrypt('jurka');
        $jurka->role = 0;
        $jurka->save();

        $laura = new User();
        $laura->name = 'laura';
        $laura->email = 'laura@gmail.com';
        $laura->password = bcrypt('laura');
        $laura->role = 0;
        $laura->save();
    }
}
