<?php

use Illuminate\Database\Seeder;
use App\Models\UsersAnswer;
use App\Models\User;
use Carbon\Carbon;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=5; $i++){
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => $i,
                'option_id' => rand(1,2),
                'class_id' => 0,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 6,
            'option_id' => 0,
            'class_id' => 0,
            'answer' => 105,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $x=3;
        for($i=7; $i<=9; $i++) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => $i,
                'option_id' => rand($x, $x+2),
                'class_id' => 0,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $x+=3;
            $ans->save();
        }
        $schools = User::find(1)->schools;
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $x=12;
            for ($i = 10; $i <= 13; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => rand($x, $x+2),
                    'class_id' => $class->id,
                    'answer' => "answer",
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
                $x+=3;
            }
        }
    }
}
