<?php

use Illuminate\Database\Seeder;
use App\Models\Options;
use App\Models\Questions;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            new Questions([
                'question' => "সীমানা প্রাচীর আছে কিনা?",
                'type' => 'checkbox'

            ]),
            new Questions([
                'question' => "খেলার মাঠ আছে কিনা?",
                'type' => 'checkbox'

            ]),
            new Questions([
                'question' => "শিক্ষক  কমনরুম আছে কিনা?",
                'type' => 'checkbox'

            ]),
            new Questions([
                'question' => "পর্যাপ্ত শ্রেণি কক্ষ আছে কিনা?",
                'type' => 'checkbox'

            ]),
            new Questions([
                'question' => "গেইট আছে কিনা?",
                'type' => 'checkbox'

            ]),
        ];

        Options::create([
            'option' => "হ্যাঁ",
            'option_value' =>1,
        ]);
        Options::create([
            'option' => "না",
            'option_value' =>0,
        ]);

        $op = Options::find(1);
        $op->questions()->saveMany($questions);
        $q= Questions::find(1);
       // $q->options()->attach($op);

        $op = Options::find(2);
        //$q->options()->attach($op);
        $op->questions()->saveMany($questions);

        $qu = new Questions();
        $qu->question = "শ্রেণি কক্ষের মোট সংখ্যা?";
        $qu->type = "input";
        $qu->save();

        $options = [
            new Options([
                'option' => "পরিষ্কার পরিচ্ছন্ন",
                'option_value' => 0
            ]),
            new Options([
                'option' => "মোটামোটি পরিষ্কার পরিচ্ছন্ন",
                'option_value' => 1
            ]),
            new Options([
                'option' => "অপরিষ্কার",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষা প্রতিষ্ঠানের  আঙ্গিনা",
            'type' => 'option'

        ]);
         $qa->save();
        $qa->options()->saveMany($options);
        $options = [
            new Options([
                'option' => "ব্যবহারের  যোগ্য",
                'option_value' => 0
            ]),
            new Options([
                'option' => "ব্যবহারের  যোগ্য নয়",
                'option_value' => 1
            ]),
            new Options([
                'option' => "ব্যবস্থা নেই",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষার্থীদের টয়লেট",
            'type' => 'option'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);
        $options = [
            new Options([
                'option' => "পর্যাপ্ত ব্যবস্থা",
                'option_value' => 0
            ]),
            new Options([
                'option' => "অপর্যাপ্ত",
                'option_value' => 1
            ]),
            new Options([
                'option' => "ব্যবস্থা নেই",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষার্থীদের নিরাপদ পানীয় জল",
            'type' => 'option'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);


    }
}
