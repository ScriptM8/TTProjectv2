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
        Schema::disableForeignKeyConstraints();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PosterSeeder::class,
            FeedbacksSeeder::class
        ]);
        Schema::enableForeignKeyConstraints();

    }
}
