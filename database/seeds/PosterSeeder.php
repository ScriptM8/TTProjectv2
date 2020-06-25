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

        Poster::create(array('id' => 1, 'author_id' => 1, 'title' => 'Suņu izvešana', 'description' => 'Izved manu mīlo pūkaino sunīti pastaigāties <3', 'category_id' => '2', 'location' => 'Daugavpils', 'time' => '12:00', 'reward' => '5.00', 'phone' => 6942069, 'email' => 'šarlatans@galva.te'));
        Poster::create(array('id' => 2, 'author_id' => 2, 'title' => 'Kaķu aprūpe', 'description' => 'Pabaro manu kakiti', 'category_id' => '2', 'location' => 'Rīga', 'time' => '18:00', 'reward' => '3.00', 'phone' => 420000, 'email' => 'kakitis@vista.hey'));
        Poster::create(array('id' => 3, 'author_id' => 2, 'title' => 'Siltumnīcas darbs', 'description' => 'Nolasi gurķus siltumnīcā', 'category_id' => '1', 'location' => 'Alūksne', 'time' => '10:00', 'reward' => '10.00', 'phone' => 60009, 'email' => 'vecmamma@aluksne.lv'));
        Poster::create(array('id' => 4, 'author_id' => 3, 'title' => 'Portrētu zīmēšana', 'description' => 'Vajag cilvēka portrēts dāvanai', 'category_id' => '4', 'location' => 'Dobele', 'time' => '10:00', 'reward' => '14.20', 'phone' => 8800555, 'email' => 'leonardo@vinci.lv'));
        Poster::create(array('id' => 5, 'author_id' => 3, 'title' => 'Vajadzīgs palīgs celtniecības objektā', 'description' => 'Vajadzīgs stiprs virietis, lai celtu ķieģeļus.', 'category_id' => '6', 'location' => 'Valmiera', 'time' => '12:28', 'reward' => '10.00', 'phone' => 1337228, 'email' => 'strojka@NB.ru'));
    }
}
