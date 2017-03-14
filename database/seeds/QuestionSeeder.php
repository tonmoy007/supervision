<?php

use Illuminate\Database\Seeder;
use App\Models\Options;
use App\Models\Questions;
use App\Models\QuestionType;

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
                'type' => 'radio'

            ]),
            new Questions([
                'question' => "খেলার মাঠ আছে কিনা?",
                'type' => 'radio'

            ]),
            new Questions([
                'question' => "শিক্ষক  কমনরুম আছে কিনা?",
                'type' => 'radio'

            ]),
            new Questions([
                'question' => "পর্যাপ্ত শ্রেণি কক্ষ আছে কিনা?",
                'type' => 'radio'

            ]),
            new Questions([
                'question' => "গেইট আছে কিনা?",
                'type' => 'radio'

            ]),
        ];

        Options::create([
            'option' => "হ্যাঁ",
            'option_value' =>0,
        ]);
        Options::create([
            'option' => "না",
            'option_value' =>1,
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
            'type' => 'select'

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
            'type' => 'radio'

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
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "উত্তম",
                'option_value' => 0
            ]),
            new Options([
                'option' => "মধ্যম",
                'option_value' => 1
            ]),
            new Options([
                'option' => "পরিষ্কার",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "পরিষ্কার পরিচ্ছন্নতা",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "পর্যাপ্ত",
                'option_value' => 0
            ]),
            new Options([
                'option' => "মধ্যম",
                'option_value' => 1
            ]),
            new Options([
                'option' => "অপর্যাপ্ত",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষা উপকরণ ও সজ্জিতকরণ",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "পর্যাপ্ত",
                'option_value' => 0
            ]),
            new Options([
                'option' => "মধ্যম",
                'option_value' => 1
            ]),
            new Options([
                'option' => "ব্যবহার উপযোগী নয়",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "ব্ল্যাকবোর্ডের অবস্থা",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "ইউ আকৃতির",
                'option_value' => 0
            ]),
            new Options([
                'option' => "একপাশে (সনাতন পদ্ধতি )",
                'option_value' => 1
            ]),
            new Options([
                'option' => "কোন পদ্ধতি অনুসরণ করা হয় না",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষার্থীদের বসার অবস্থা",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $type =new QuestionType([
                'type' => "বিজ্ঞানাগার"
            ]);
        $type->save();

        $type = new QuestionType([
                'type' => "কম্পিউটার ল্যাব"
            ]);
        $type->save();
        $type = new QuestionType([
                'type' => "লাইব্রেরী"
            ]);
        $type->save();


        $options = [
            new Options([
                'option' => "আছে",
                'option_value' => 0
            ]),
            new Options([
                'option' => "নাই",
                'option_value' => 1
            ]),
            new Options([
                'option' => "ব্যাবহার উপযোগী",
                'option_value' => 2
            ]),
            new Options([
                'option' => "ব্যাবহার উপযোগী নয়",
                'option_value' => 3
            ]),

        ];
        $qa = new Questions([
            'question' => "পৃথক কক্ষ",
            'type' => 'select'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "পর্যাপ্ত",
                'option_value' => 0
            ]),
            new Options([
                'option' => "অপর্যাপ্ত",
                'option_value' => 1
            ]),
            new Options([
                'option' => "ব্যাবহার উপযোগী নয়",
                'option_value' => 3
            ]),

        ];
        $qa = new Questions([
            'question' => "বৈজ্ঞানিক সরঞ্জামাদি / কম্পিউটার / বই পুস্তক",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $options = [
            new Options([
                'option' => "ব্যবহার হয়",
                'option_value' => 0
            ]),
            new Options([
                'option' => "ব্যবহার  হয় না",
                'option_value' => 1
            ]),
        ];
        $qa = new Questions([
            'question' => "নিয়মিত কার্যক্রম ব্যবহার",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $qu = new Questions();
        $qu->question = "ব্যবহারকারী শিক্ষার্থীর সংখ্যা ( গত মাসের)";
        $qu->type = "input";
        $qu->save();

        $questions = [
            new Questions([
                'question' => "শিক্ষার্থীর সংখ্যা",
                'type' => 'input'

            ]),
            new Questions([
                'question' => "উপস্থিত  শিক্ষার্থীর সংখ্যা",
                'type' => 'input'

            ]),
            new Questions([
                'question' => "বিগত মাসে একাধারে ৫ বা ততোধিক দিন অনুপস্থিত শিক্ষার্থীর সংখ্যা",
                'type' => 'input'

            ]),

        ];
        $oop = new Options([
            'option' => "ছাত্র",
            'option_value' =>0,
        ]);
        $oop->save();

        $op = Options::find($oop->id);
        $op->questions()->saveMany($questions);
        $oop = new Options([
            'option' => "ছাত্রী",
            'option_value' =>1,
        ]);
        $oop->save();
        $op = Options::find($oop->id);
        //$q->options()->attach($op);
        $op->questions()->saveMany($questions);

        $qu = new Questions();
        $qu->question = "একাধারে ৫ বা ততোধিক দিন অনুপস্থিত শিক্ষার্থীর বিষয়ে গৃহীত ব্যবস্থা";
        $qu->type = "input";
        $qu->save();

    }
}
