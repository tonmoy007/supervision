<?php

namespace App\Http\Controllers\Questions;

use App\Models\Options;
use App\Models\Questions;
use App\Models\QuestionType;
use App\Models\User;
use App\Models\UsersAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class QuestionController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $method = $request->method();
        /*if($method != 'post') {
            return;
        }*/
        try {
            $this->middleware('ability:token',['except' => ['index']]);
            $this->user = JWTAuth::parseToken()->toUser();
        }catch (TokenExpiredException $e) {
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            $this->user = JWTAuth::setToken($newToken)->toUser();
        }
    }
    public function index(){
        $menu = [
            ['title' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "environments"],
            ['title' => "শ্রেণীকক্ষ সংক্রান্ত তথ্য", 'url' => "classrooms"],
            ['title' => "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)", 'url' => "sciencelab"],
            ['title' => "শিক্ষক সংক্রান্ত  তথ্য", 'url' => "students"],
            ['title' => "শ্রেণী পাঠদান পর্যবেক্ষণ  ( নূয়নতম দুটি ক্লাস পর্যবেক্ষণ করে শ্রেণির তথ্য পূরণ করুন )", 'url' => "environments"],
            ['title' => "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )", 'url' => "environments"],
            ['title' => "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য", 'url' => "environments"],
            ['title' => "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য", 'url' => "environments"],
            ['title' => "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা", 'url' => "environments"],
            ['title' => "সভা সংক্রান্ত তথ্য", 'url' => "environments"],
            ['title' => "সহ-শিক্ষাক্রমিক কার্যক্রম", 'url' => "environments"],
            ['title' => "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য", 'url' => "environments"],
            ['title' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য", 'url' => "environments"],
            ['title' => "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য", 'url' => "environments"],
            ['title' => "পরীক্ষার ফলাফল সম্পর্কিত তথ্য", 'url' => "environments"],
            ['title' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ", 'url' => "environments"],
            ['title' => "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য", 'url' => "environments"],
        ];
        $message = "Menue found";
        return response()->json(['success'=>1,'message'=> $message, 'menu' => $menu]);


    }
    public function environment() {
        $questions = Questions::where('id', '<=', 9)->with('options')->get();

        //die(var_dump($questions->questions));
        $title = ['value' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "environments"];

        $QA = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $this->user->id)->where('question_id', $question->id)->first();

            $opt = array();
            if($ans != null) {
                if($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt =  $opt->toArray();
                }else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value"=> (int)$ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }

            }
            $qa['answer'] = $opt;
            array_push($QA, $qa);
        }
        $message = "Environment question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
        die(var_dump($QA));
        die(var_dump($question->toArray()));
        $options = $question->options;
        die(var_dump($options->toArray()));
    }
    public function environmentAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }

        foreach ($answers as $answer) {
            $answerID = 0;
            if(isset($answer['answer_id']) && $answer['answer_id'] != "0"){
                $answerID = $answer['answer_id'];
            }
            $ans = 0;
            if(isset($answer['option_value'])) {
                $ans = $answer['option_value'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $this->user->id,
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                ],
                [
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answerID,
                'class_id' => 0,
                'answer' => $ans,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);

    }

    public function classroom() {
        $questions = Questions::where('id', '>', 9)->where('id', '<=', 13)->with('options')->get();
        $title = ['value' => "শ্রেণীকক্ষ সংক্রান্ত তথ্য", 'url' => "classrooms"];
        $QA = array();
        $schools = User::find($this->user->id)->schools;
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $this->user->id)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    $opt = Options::where('id', $ans->option_id)->first();

                    $opt = $opt->toArray();
                }
                $qa['answer'] = $opt;
                array_push($qs, $qa);
            }
            $cl['questions'] = $qs;
            array_push($QA, $cl);
        }
        $message = "Classroom question found";
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function classroomAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        foreach ($answers as $answer) {
            $ans =  UsersAnswer::updateOrCreate([
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                ],
                [
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                'class_id' => $answer['class_id'],
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function scienceLab() {
        $questions = Questions::where('id', '>', 13)->where('id', '<=', 17)->with('options')->get();
        $title = ['value' => "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)", 'url' => "scincelab"];
       // die(var_dump($questions->toArray()));
        $QA = array();
        $types = QuestionType::where('id', '>=', 1)->where('id', '<=', 3)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $this->user->id)->where('question_id', $question->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => (int)$ans->answer,
                            "created_at" => "",
                            "updated_at" => ""
                        ];
                    }
                }
                $qa['answer'] = $opt;
                array_push($qs, $qa);
            }
            $cl['questions'] = $qs;
            array_push($QA, $cl);
        }
        $message = "Classroom question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function scienceLabAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        foreach ($answers as $answer) {
            $answerID = 0;
            if(isset($answer['answer_id'])){
                $answerID = $answer['answer_id'];
            }
            $ans = 0;
            if(isset($answer['option_value'])) {
                $ans = $answer['option_value'];
            }
            $ans = UsersAnswer::updateOrCreate([
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                ],
                [
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answerID,
                'class_id' => $answer['type_id'],
                'answer' => $ans,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function students() {
        $questions = Questions::where('id', '>', 17)->where('id', '<=', 21)->with('options')->get();
        $title = ['value' => "শিক্ষক সংক্রান্ত  তথ্য", 'url' => "students"];
        // die(var_dump($questions->toArray()));
        $QA = array();
        $schools = User::find($this->user->id)->schools;
        $classes = $schools->classes;
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $this->user->id)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    $opt = Options::where('id', $ans->option_id)->first();

                    $opt = $opt->toArray();
                }
                $qa['answer'] = $opt;
                array_push($qs, $qa);
            }
            $cl['questions'] = $qs;
            array_push($QA, $cl);
        }
        $message = "Students question found";
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function studentsAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        foreach ($answers as $answer) {
            $ans = UsersAnswer::updateOrCreate([
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                ],
                [
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                'class_id' => $answer['class_id'],
                'answer' => $answer['option_value'],
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }
}
