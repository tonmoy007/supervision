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

        $options = [
            new Options([
                'option' => "সম্পূর্ণ হালনাগাদ",
                'option_value' => 0
            ]),
            new Options([
                'option' => "আংশিক হালনাগাদ",
                'option_value' => 1
            ]),
            new Options([
                'option' => "হালনাগাদ নয়",
                'option_value' => 2
            ]),
        ];
        $qa = new Questions([
            'question' => "প্রতিষ্ঠান প্রধানের রেজিস্টার",
            'type' => 'radio'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $type =new QuestionType([
            'type' => "সম্পূর্ণ হালনাগাদ"
        ]);
        $type->save();

        $type = new QuestionType([
            'type' => "আংশিক হালনাগাদ"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "হালনাগাদ নয়"
        ]);
        $type->save();

        $qa = new Questions([
            'question' => "শিক্ষকের ডায়েরি (সংখ্যায় )",
            'type' => 'input'

        ]);
        $qa->save();

        $qa = new Questions([
            'question' => "মন্তব্য",
            'type' => 'textarea'
        ]);
        $qa->save();

        $qa = new Questions([
            'question' => "প্রতিষ্ঠান প্রধান শ্রেনি পাঠদান পর্যবেক্ষন করেন",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "শ্রেনি পাঠদান পর্যবেক্ষন করে থাকলে বিগত একমাসে কতজন শিক্ষকের শ্রেনি পাঠদান পর্যবেক্ষন করেছেন",
            'type' => 'input'
        ]);
        $qa->save();

        $type =new QuestionType([
            'type' => "প্রতিষ্ঠান প্রধান শিখন-শিখানো বিষয়ে গুরুত্ব দিয়ে পূর্ণ শিক্ষক সভা আয়োজন করেন কিনা"
        ]);
        $type->save();

        $type = new QuestionType([
            'type' => "বিষয়ভিত্তিক শিক্ষক সভা আয়োজন করেন কিনা (প্রতি টার্মে ১ বার)"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "নিয়মিত এসএমসি সভা করেন কিনা (দুই মাসে ১ টি) (এসএমসি সংক্রান্ত সমস্যা থাকলে মন্তব্যের কলামে উল্লেখ করুন) "
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "নিয়মিত পিটিএ/অভিভাবক সভা করেন কিনা (প্রতি টার্মে ১ বার)"
        ]);
        $type->save();

        $qa = new Questions([
            'question' => "হ্যা/না",
            'type' => 'radio'
        ]);
        $qa->save();
        $qa->options()->saveMany($yesno);
        $qa = new Questions([
            'question' => "সর্বশেষ সভার তারিখ",
            'type' => 'datepicker'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রেজিস্টার সংরক্ষণ করা হয় কিনা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "সভা সংক্রান্ত মন্তব্য",
            'type' => 'textarea'
        ]);
        $qa->save();

        $type = new QuestionType([
            'type' => "৬ষ্ট - ১০ম"
        ]);
        $type->save();
        $qa = new Questions([
            'question' => "বিগত মাস্যা গৃহীত সহ - শিক্ষাক্রমিক কার্যক্রমের নাম",
            'type' => 'text'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রেজিস্টার সংরক্ষণ করা হয় কিনা",
            'type' => 'text'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "সহ - শিক্ষাক্রমিক মন্তব্য",
            'type' => 'textarea'
        ]);
        $qa->save();

        $options = [
            new Options([
                'option' => "স্বল্প  কৃতিধারী শিক্ষার্থীদের চিহ্নিত করে পদক্ষেপ গ্রহণ করা হয়",
                'option_value' => 0
            ]),
            new Options([
                'option' => "স্বল্প  কৃতিধারী শিক্ষার্থীদের চিহ্নিত করা হয় কিন্তু কোন পদক্ষেপ গ্রহণ করা হয় না",
                'option_value' => 1
            ]),
            new Options([
                'option' => "স্বল্প  কৃতিধারী শিক্ষার্থীদের চিহ্নিত করা হয় না",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "স্বল্প  কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ",
            'type' => 'select'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);


        $options = [
            new Options([
                'option' => "প্রতিষ্ঠানের শিক্ষকগণ সৃজনশীল প্রশ্ন প্রণয়ন করেন",
                'option_value' => 0
            ]),
            new Options([
                'option' => "অন্য প্রতিষ্ঠানের সহযোগিতায় সৃজনশীল প্রশ্ন প্রণয়ন করেন ",
                'option_value' => 1
            ]),
            new Options([
                'option' => "বাহির থেকে সৃজনশীল প্রশ্ন সংগ্রহ করেন ",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি",
            'type' => 'select'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $type = new QuestionType([
            'type' => "ধারাবাহিক মূল্যায়ন (CA) অনুসারে শিক্ষার্থীর কৃতিত্বের রেকর্ড সংরক্ষণ"
        ]);
        $type->save();
        $qa = new Questions([
            'question' => "পূর্ণাঙ্গ রেকর্ড সংরক্ষণকারী শিক্ষকের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "আংশিকভাবে রেকর্ড সংরক্ষণকারী শিক্ষকের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রেকর্ড সংরক্ষণ করেন না এরূপ শিক্ষকের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();

        $qa = new Questions([
            'question' => "অংশগ্রহণকারী শিক্ষার্থী সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "কৃতকার্য শিক্ষার্থী সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "অকৃতকার্য শিক্ষার্থীর মানোন্নয়নে গৃহীত পদক্ষেপ",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "পরীক্ষার ফলাফল উন্নয়নে পরিদর্শণকারী কর্মকর্তার সুপারিশ",
            'type' => 'input'
        ]);
        $qa->save();

        $type = new QuestionType([
            'type' => "জে.এস.সি / জে.ডি.সি"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "এস.এস.সি / দাখিল"
        ]);
        $type->save();

        $type = new QuestionType([
            'type' => "ভৌত পরিবেশ উন্নয়ন সংক্রান্ত"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "পিবিএম বাস্তবায়ন সংক্রান্ত"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "শ্রেণি পাঠদান সংক্রান্ত"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "সৃজনশীল প্রশ্নের মানোন্নয়ন"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "D ও  E ক্যাটাগরিভুক্ত প্রতিষ্ঠানের  মানোন্নয়ন"
        ]);
        $type->save();
        $type = new QuestionType([
            'type' => "অন্যান্য"
        ]);
        $type->save();
        $options = [
            new Options([
                'option' => "সন্তোষজনক",
                'option_value' => 0
            ]),
            new Options([
                'option' => "মোটামুটি",
                'option_value' => 1
            ]),
            new Options([
                'option' => "সন্তোষজনক নয়",
                'option_value' => 2
            ]),

        ];
        $qa = new Questions([
            'question' => "বর্তমান অবস্থা",
            'type' => 'select'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);

        $qa = new Questions([
            'question' => "পরিদর্শনকারী কর্মকর্তার সুপারিশ",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়নে মন্তব্য",
            'type' => 'textarea'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "পরিদর্শণকারী কর্মকর্তার সার্বিক মন্তব্য",
            'type' => 'textarea'
        ]);
        $qa->save();

        //supervisor question
        $qa = new Questions([
            'question' => "জেলার নাম",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "উপজেলার সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "জেলা শিক্ষা কর্মকর্তার নাম",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "মোবাইল নং",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "জেলার মোট শিক্ষা প্রতিষ্ঠানের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "জেলার মোট ক্লাস্টারের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রিপোর্টিং মাসে পরিদর্শণকৃত শিক্ষা প্রতিষ্ঠানের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "ই-মেইল",
            'type' => 'email'
        ]);
        $qa->save();

        /*$qa = new Questions([
            'question' => "ক্রমিক নং",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তার নাম ও পদবী",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "ক্লাস্টার ভুক্ত মোট শিক্ষা প্রতিষ্ঠানের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রিপোর্টিং মাসে পরিদর্শণকৃত শিক্ষা প্রতিষ্ঠানের সংখ্যা",
            'type' => 'input'
        ]);
        $qa->save(); */
        $qa = new Questions([
            'question' => "রিপোর্টিং মাসে কোন কর্মকর্তা বদলি হয়ে থাকলে তার নামঃ",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "বদলিকৃত কর্মকর্তা স্থলে নতুন কর্মকর্তা যোগদান করে থাকলে তার নামঃ",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "রিপোর্টিং মাসে ক্লাস্টার বণ্টনে কোন পরিবর্তন হয়ে থাকলে তার বিবরণঃ",
            'type' => 'input'
        ]);
        $qa->save();

        //teacher present
        $qa = new Questions([
            'question' => "মোট",
            'type' => 'input'
        ]);
        $qa->save();
        $qa = new Questions([
            'question' => "মহিলা",
            'type' => 'input'
        ]);
        $qa->save();

        $type =new QuestionType([
            'type' => "কর্মরত"
        ]);
        $type->save();

        $type = new QuestionType([
            'type' => "উপস্থিত"
        ]);
        $type->save();
        //end teacher present

        //school category for admin report
        $options = [
            new Options([
                'option' => "এ ক্যাটাগরি",
                'option_value' => 0
            ]),
            new Options([
                'option' => "বি ক্যাটাগরি",
                'option_value' => 1
            ]),
            new Options([
                'option' => "সি ক্যাটাগরি",
                'option_value' => 2
            ]),
            new Options([
                'option' => "ডি ক্যাটাগরি",
                'option_value' => 3
            ]),
            new Options([
                'option' => "ই ক্যাটাগরি",
                'option_value' => 4
            ]),

        ];
        $qa = new Questions([
            'question' => "শিক্ষা প্রতিষ্ঠানের  ক্যাটাগরি",
            'type' => 'select'

        ]);
        $qa->save();
        $qa->options()->saveMany($options);


    }
}
