<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $darzaDarbi = new Category();
        $darzaDarbi->name = 'Dārza darbi';
        $darzaDarbi->icon_path = 'c1.png';
        $darzaDarbi->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Mājdzivnieku aprūpe';
        $majdzivniekuAprupe->icon_path = 'c2.png';
        $majdzivniekuAprupe->save();

        $precuParvadajumi = new Category();
        $precuParvadajumi->name = 'Preču pārvadājumi';
        $precuParvadajumi->icon_path = 'c3.png';
        $precuParvadajumi->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Māksla';
        $majdzivniekuAprupe->icon_path = 'c4.png';
        $majdzivniekuAprupe->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Bizness';
        $majdzivniekuAprupe->icon_path = 'c5.png';
        $majdzivniekuAprupe->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Celtniecība';
        $majdzivniekuAprupe->icon_path = 'c6.png';
        $majdzivniekuAprupe->save();

    }
}
