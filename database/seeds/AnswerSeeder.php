<?php

use Illuminate\Database\Seeder;
use App\Models\UsersAnswer;
use App\Models\User;
use Carbon\Carbon;
use App\Models\QuestionType;

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

        $types = QuestionType::where('id', '>=', 1)->where('id', '<=', 3)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $x=24;

            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 14,
                'option_id' => rand(24, 27),
                'class_id' => $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 15,
                'option_id' => rand(28, 30),
                'class_id' => $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 16,
                'option_id' => rand(31, 32),
                'class_id' => $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 17,
                'option_id' => 0,
                'class_id' => $type->id,
                'answer' => rand(40, 100),
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }

        $schools = User::find(1)->schools;
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $x=12;
            for ($i = 18; $i <= 21; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $class->id,
                    'answer' => rand(50, 100),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
                $x+=3;
            }
        }
    }
}
