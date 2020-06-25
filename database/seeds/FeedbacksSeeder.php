<?php

use Illuminate\Database\Seeder;
use App\Feedbacks;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedbacks::truncate();

        $f1 = new Feedbacks();
        $f1->author_id = 1;
        $f1->target_id = 2;
        $f1->rating = 4;
        $f1->description = 'Labs darbs!';
        $f1->save();

        $f2 = new Feedbacks();
        $f2->author_id = 2;
        $f2->target_id = 1;
        $f2->rating = 2;
        $f2->description = 'Nepatika.';
        $f2->save();

        $f3 = new Feedbacks();
        $f3->author_id = 3;
        $f3->target_id = 1;
        $f3->rating = 1;
        $f3->description = 'Nebija jau tik slikti, es tikai ākstos!';
        $f3->save();
    }
}
