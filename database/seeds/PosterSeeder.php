<?php

use Illuminate\Database\Seeder;
use App\Poster;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poster::truncate();

        Poster::create(array('id' => 1, 'author_id' => 1, 'title' => 'Sunīši', 'Description' => 'Izved manu mīlo pūkaino sunīti pastaigāties <3', 'category_id' => '2', 'location' => 'Daugavpils', 'time' => '12:00', 'reward' => '5.00', 'phone' => 6942069, 'email' => 'šarlatans@galva.te'));
        Poster::create(array('id' => 2, 'author_id' => 2, 'title' => 'Kakisi', 'Description' => 'Pabaro manu kakiti', 'category_id' => '2', 'location' => 'Rīga', 'time' => '18:00', 'reward' => '3.00', 'phone' => 420000, 'email' => 'kakitis@vista.hey'));
        Poster::create(array('id' => 3, 'author_id' => 2, 'title' => 'Gurķīši', 'Description' => 'Nolasi gurķus siltumnīcā', 'category_id' => '1', 'location' => 'Alūksne', 'time' => '10:00', 'reward' => '10.00', 'phone' => 60009, 'email' => 'vecmamma@aluksne.lv'));
    }
}
