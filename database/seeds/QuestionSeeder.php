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

        $type =new QuestionType([
            'type' => "পুরুষ"
        ]);
        $type->save();
        $type =new QuestionType([
            'type' => "মহিলা"
        ]);
        $type->save();
        $type =new QuestionType([
            'type' => "মোট"
        ]);
        $type->save();

        $qu = new Questions();
        $qu->question = "কর্মরত শিক্ষক";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "এমপিও ভুক্ত শিক্ষক";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "খন্ডকালীন শিক্ষক";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "বিএড";
        $qu->type = "input";
        $qu->save();

        $qu = new Questions();
        $qu->question = "পিবিএম প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "সিকিঊ প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "কারিকুলাম প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "সিপিডি প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "কম্পিউটার প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "আইসিটি প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "অফিস ব্যবস্থাপনা প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "অন্যান্য প্রশিক্ষণ";
        $qu->type = "input";
        $qu->save();

        $yesno = [
            new Options([
                'option' => "হ্যাঁ",
                'option_value' => 0
            ]),
            new Options([
                'option' => "না",
                'option_value' => 1
            ]),
        ];
        $qa = new Questions([
            'question' => "শিক্ষকদের প্রশিক্ষণ সংক্রান্ত রেজিস্টার সংরক্ষণ করা হয় কিনা",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qu = new Questions();
        $qu->question = "বিষয়ের নাম";
        $qu->type = "input";
        $qu->save();
        $qa = new Questions([
            'question' => "শিক্ষক পাঠ পরিকল্পনা অনুসরণ করছেন",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "ব্ল্যাক বোর্ডে পাঠ শিরোনাম যথাযথ ভাবে লিখা ছিল কিনা",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "শিক্ষক পুরো শ্রেণীকক্ষ ঘুরে পাঠদান ও দলীয় কাজে সহায়তা করেছেন ",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "পাঠদানে অংশগ্রহণ মূলক পদ্ধতিতে সকল শিক্ষার্থী অংশগ্রহণ করেছে",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "শিক্ষার্থীরা দলীয় কাজ উপস্থাপন করেছে বা ব্ল্যাকবোর্ড ব্যবহার করেছে",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "শিক্ষা উপকরণ ব্যবহ্রত হয়েছে",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qa = new Questions([
            'question' => "শিক্ষক বাড়ির কাজ পর্যবেক্ষণ করে শিক্ষার্থীদের পরামর্শ দিয়েছেন ",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qa = new Questions([
            'question' => "শিক্ষক সময় সম্পর্কে সচেতন ছিলেন",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qa = new Questions([
            'question' => "ডিজিটাল কন্টেন্ট ব্যবহার করে ক্লাস নেয়া হয়েছে কিনা ?",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $options = [
            new Options([
                'option' => "পুরো সময়",
                'option_value' => 0
            ]),
            new Options([
                'option' => "আংশিক",
                'option_value' => 1
            ]),
        ];
        $qa = new Questions([
            'question' => "পাঠদানে বক্তৃতা পদ্ধতি অনুসরণ হয়েছে",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $qu = new Questions();
        $qu->question = "ইংরেজি";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "গণিত";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "বিজ্ঞান";
        $qu->type = "input";
        $qu->save();

        $qa = new Questions([
            'question' => "রুটিনে ক্লাস আছে কিনা",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qu = new Questions();
        $qu->question = "মাল্টিমিডিয়া ব্যবহার করে সপ্তাহে কয়টি ক্লাস নয়া হয়? (ক্লাসের সংখ্যা)";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "শিক্ষকরা নিজেরাই ডিজিটাল কন্টেন্ট তৈরি করে ক্লাস নিয়ে থাকেন এরূপ শিক্ষক সংখ্যা";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "শিক্ষক বাতায়ন ব্যবহার করে ডিজিটাল কন্টেন্টের ক্লাস নেন এরূপ শিক্ষক সংখ্যা";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "অন্য কোন উৎস ব্যবহার করে ডিজিটাল কন্টেন্টের ক্লাস নেন এরূপ শিক্ষক সংখ্যা";
        $qu->type = "input";
        $qu->save();
        $qu = new Questions();
        $qu->question = "ডিজিটাল কন্টেন্টে ক্লাস নেওয়া হয় না";
        $qu->type = "input";
        $qu->save();
        $qa = new Questions([
            'question' => "স্থায়ী মাল্টিমিডিয়া ক্লাসরুম আছে কিনা? ",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

        $qa = new Questions([
            'question' => "প্রতিষ্ঠান উন্নয়নে পঞ্চবার্ষিক উন্নয়ন পরিকল্পনা প্রণয়ন করা হয়েছে কিনা ?",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "প্রতিষ্ঠান উন্নয়নে বার্ষিক উন্নয়ন পরিকল্পনা প্রণয়ন করা হয়েছে কিনা ?",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "পরিকল্পনা প্রণয়নে এসএমসি/গভর্নিং বডি/একাডেমিক কাউন্সিল, অভিভাবক, সংশ্লিষ্ট ক্লাস্টার কর্মকর্তা অংশগ্রহণ করেছেন কিনা?",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "প্রতিষ্ঠান উন্নয়ন পরিকল্পনায় লক্ষ্যমাত্রা বাস্তবায়নে সর্বশেষ এসএমসি সভা অথবা শিক্ষক সভায় আলোচনা হয়েছে কিনা?",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);

    }
}
