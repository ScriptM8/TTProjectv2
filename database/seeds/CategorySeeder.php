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
        //Category::truncate();

        $darzaDarbi = new Category();
        $darzaDarbi->name = 'Dārza darbi';
        $darzaDarbi->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Mājdzivnieku aprūpe';
        $majdzivniekuAprupe->save();

        $precuParvadajumi = new Category();
        $precuParvadajumi->name = 'Preču pārvadājumi';
        $precuParvadajumi->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Māksla';
        $majdzivniekuAprupe->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Bizness';
        $majdzivniekuAprupe->save();

        $majdzivniekuAprupe = new Category();
        $majdzivniekuAprupe->name = 'Celtniecība';
        $majdzivniekuAprupe->save();

    }
}
