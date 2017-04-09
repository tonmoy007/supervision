<?php

use Illuminate\Database\Seeder;
use App\Models\UsersAnswer;
use App\Models\User;
use Carbon\Carbon;
use App\Models\QuestionType;
use Faker\Factory as Faker;
use App\Models\SarventQuestion;

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
                'type_id' =>0,
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
            'type_id' =>0,
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
                'type_id' =>0,
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
                    'type_id' =>0,
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
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 15,
                'option_id' => rand(28, 30),
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 16,
                'option_id' => rand(31, 32),
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 17,
                'option_id' => 0,
                'class_id' => 0,
                'type_id'=> $type->id,
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
                    'type_id' =>0,
                    'answer' => rand(50, 100),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
                $x+=3;
            }
        }
        $types = QuestionType::where('id', '>=', 4)->where('id', '<=', 6)->get();
        foreach ($types as $type) {
            for ($i = 22; $i <= 25; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => 0,
                    'type_id' => $type->id,
                    'answer' => rand(50, 100),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
        }
        for ($i = 26; $i <= 33; $i++) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => $i,
                'option_id' => 0,
                'class_id' => 0,
                'type_id' =>0,
                'answer' => rand(50, 100),
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 34,
            'option_id' => rand(35,36),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $faker=Faker::create();
        foreach ($classes as $class) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 35,
                'option_id' => 0,
                'class_id' => $class->id,
                'type_id' =>0,
                'answer' => $faker->name,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            for ($i = 36; $i <= 44; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => rand(35,36),
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => 0,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 45,
                'option_id' => rand(37,38),
                'class_id' => $class->id,
                'type_id' =>0,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            for($i=46; $i<=48; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => rand(10, 40),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 49,
                'option_id' => rand(35,36),
                'class_id' => $class->id,
                'type_id' =>0,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            for($i=50; $i<=54; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => rand(10, 40),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }

                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => 55,
                    'option_id' => rand(35,36),
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => 0,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();

        }
        for($i=56; $i<=59; $i++) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => $i,
                'option_id' => rand(35,36),
                'class_id' => 0,
                'type_id' =>0,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 60,
            'option_id' => rand(39,41),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $types = QuestionType::where('id', '>=', 7)->where('id', '<=', 9)->get();
        foreach ($types as $type) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 61,
                'option_id' => 0,
                'class_id' => 0,
                'type_id' => $type->id,
                'answer' => rand(50, 100),
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();

        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 62,
            'option_id' => 0,
            'class_id' => 0,
            'type_id' =>0,
            'answer' => $faker->streetAddress,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();

        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 63,
            'option_id' => rand(35,36),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 64,
            'option_id' => 0,
            'class_id' => 0,
            'type_id' =>0,
            'answer' => rand(10,40),
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $types = QuestionType::where('id', '>=', 10)->where('id', '<=', 13)->get();
        foreach ($types as $type) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 65,
                'option_id' => rand(35,36),
                'class_id' => 0,
                'type_id' => $type->id,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 66,
                'option_id' => 0,
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => $faker->date('Y-m-d'),
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 67,
                'option_id' => 0,
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => $faker->name,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 68,
                'option_id' => 0,
                'class_id' => 0,
                'type_id'=> $type->id,
                'answer' => $faker->text(80),
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        $types = QuestionType::where('id', '=', 14)->get();
        foreach ($types as $type) {
            for($i=69; $i<=71; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => 0,
                    'type_id' => $type->id,
                    'answer' => $faker->text(80),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }

        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 72,
            'option_id' => rand(42,44),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 73,
            'option_id' => rand(45,47),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();

        $types = QuestionType::where('id', '=', 15)->get();
        foreach ($types as $type) {
            for($i=74; $i<=76; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => 0,
                    'type_id' => $type->id,
                    'answer' => rand(10,50),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
        }

        foreach ($classes as $class) {
            for($i=77; $i<=78; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => rand(100,200),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
            for($i=79; $i<=80; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $class->id,
                    'type_id' =>0,
                    'answer' => $faker->text(80),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }

        }
        $types = QuestionType::where('id', '>=', 16)->where('id', '<=', 17)->get();
        foreach ($types as $type) {
            for($i=77; $i<=78; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => 0,
                    'type_id' => $type->id,
                    'answer' => rand(100,200),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
            for($i=79; $i<=80; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $type->id,
                    'type_id' =>0,
                    'answer' => $faker->text(80),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
        }
        $types = QuestionType::where('id', '>=', 18)->where('id', '<=', 23)->get();
        foreach ($types as $type) {
            $ans = new UsersAnswer([
                'user_id' => 1,
                'question_id' => 81,
                'option_id' => rand(48,50),
                'class_id' => 0,
                'type_id' => $type->id,
                'answer' => 0,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
            for($i=82; $i<=83; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => $type->id,
                    'type_id' =>0,
                    'answer' => $faker->text(80),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
        }
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 84,
            'option_id' => 0,
            'class_id' => 0,
            'type_id' =>0,
            'answer' => $faker->text(180),
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();
        $ans = new UsersAnswer([
            'user_id' => 1,
            'question_id' => 98,
            'option_id' => rand(51,55),
            'class_id' => 0,
            'type_id' =>0,
            'answer' => 0,
            'xtra' => 'education',
            'answer_date' => Carbon::now()->toDateString()
        ]);
        $ans->save();

        //supervisor

        $ans = new SarventQuestion([
            'user_id' =>2,
            'serial_no' => '১',
            'responsible' => $faker->title,
            'total_school' => rand(10,20),
            'present_school' => rand(10,20),

        ]);
        $ans->save();
        $ans = new SarventQuestion([
            'user_id' =>2,
            'serial_no' => '২',
            'responsible' => $faker->title,
            'total_school' => rand(10,20),
            'present_school' => rand(10,20),

        ]);
        $ans->save();

        $types = QuestionType::where('id', '>=', 24)->where('id', '<=', 25)->get();
        foreach ($types as $type) {
            for ($i = 96; $i <= 97; $i++) {
                $ans = new UsersAnswer([
                    'user_id' => 1,
                    'question_id' => $i,
                    'option_id' => 0,
                    'class_id' => 0,
                    'type_id' => $type->id,
                    'answer' => rand(100, 200),
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
                $ans->save();
            }
        }


    }
}
