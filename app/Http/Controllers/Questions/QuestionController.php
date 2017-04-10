<?php

namespace App\Http\Controllers\Questions;

use App\Models\Options;
use App\Models\Questions;
use App\Models\QuestionType;
use App\Models\School;
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
    protected $school;
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
        if($this->user->roles->first()['name'] != 'admin') {
            $this->school = School::where('user_id', $this->user->id)->first();
        }

    }
    public function index(){
        $userID = $this->user->id;
        $roles = User::find($userID)->roles;
        if($roles[0]->name == "general_user") {
            $menu = [
                ['title' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "environments"],
                ['title' => "শ্রেণীকক্ষ সংক্রান্ত তথ্য", 'url' => "classrooms"],
                ['title' => "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)", 'url' => "sciencelab"],
                ['title' => "শিক্ষার্থী সংক্রান্ত তথ্য (পরিদর্শন তারিখে)", 'url' => "students"],
                ['title' => "শিক্ষক সংক্রান্ত  তথ্য", 'url' => "teachers"],
                ['title' => "শ্রেণী পাঠদান পর্যবেক্ষণ  ( নূয়নতম দুটি ক্লাস পর্যবেক্ষণ করে শ্রেণির তথ্য পূরণ করুন )", 'url' => "lectures"],
                ['title' => "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )", 'url' => "multimedia"],
                ['title' => "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য", 'url' => "yearlyplan"],
                ['title' => "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য", 'url' => "diary"],
                ['title' => "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা", 'url' => "study"],
                ['title' => "সভা সংক্রান্ত তথ্য", 'url' => "meetings"],
                ['title' => "শিক্ষক উপস্থিতি ", 'url' => "teacherpresent"],
                ['title' => "সহ-শিক্ষাক্রমিক কার্যক্রম", 'url' => "extracuriculumn"],
                ['title' => "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য", 'url' => 'lastbenchers'],
                ['title' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য", 'url' => "creative"],
                ['title' => "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য", 'url' => "assessment"],
                ['title' => "পরীক্ষার ফলাফল সম্পর্কিত তথ্য", 'url' => "result"],
                ['title' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ", 'url' => "academic"],
              //  ['title' => "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য", 'url' => "comment"],
            ];
        } else {
            $menu = [
                ['title' => "সাধারণ তথ্য", 'url' => "general"],
                ['title' => "ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তাগণের তথ্য", 'url' => "responsibility"],
                ['title' => "কর্মকর্তাগণের বদলি এবং ক্লাস্টার পরিবর্তনের বিবরণ", 'url' => "transfer"],
               // ['title' => "ভৌত অবকাঠামোগত সুবিধাবঞ্চিত প্রতিষ্ঠানসমূহের তথ্য (সংখ্যা)", 'url' => "infrastructure"],
                //['title' => " রিপোর্টিং মাসে পিবিএম বাস্তবায়ন সংক্রান্ত তথ্য", 'url' => "pbm"],
                            ];
        }
        $message = "Menue found";
        return response()->json(['success'=>1,'message'=> $message, 'menu' => $menu]);


    }
    public function environment($schoolID=0) {
        $questions = Questions::where('id', '<=', 9)->with('options')->get();

        //die(var_dump($questions->questions));
        $title = ['value' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "environments"];

        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();

            $opt = array();
            if($ans != null) {
                if($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt =  $opt->toArray();
                }else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value"=> $ans->answer,
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
    }
    public function environmentAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                'question_id' => $answer['question_id'],
                'option_id' => $answerID,
                'answer' => $ans,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);

    }

    public function classroom($schoolID=0) {
        $questions = Questions::where('id', '>', 9)->where('id', '<=', 13)->with('options')->get();
        $title = ['value' => "শ্রেণীকক্ষ সংক্রান্ত তথ্য", 'url' => "classrooms"];
        $QA = array();
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $schools = School::getById($userID);
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    if($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt =  $opt->toArray();
                    }else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value"=> $ans->answer,
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
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function classroomAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }

        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
        }

        foreach ($answers as $answer) {
            $classId= 0;
            $typeId=0;
            $answerId =0;
            if(isset($answer['answer_id'])) {
                $answerId = $answer['answer_id'];
            }
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ans =  UsersAnswer::updateOrCreate([
                'user_id' => $userID,
                'question_id' => $answer['question_id'],
                'class_id' => $classId,
                'type_id' => $typeId,
                ],
                [
                'question_id' => $answer['question_id'],
                'option_id' => $answerId,
                'answer' => "answer",
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function scienceLab($schoolID=0) {
        $questions = Questions::where('id', '>', 13)->where('id', '<=', 17)->with('options')->get();
        $title = ['value' => "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)", 'url' => "scincelab"];
       // die(var_dump($questions->toArray()));
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $QA = array();
        $types = QuestionType::where('id', '>=', 1)->where('id', '<=', 3)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId =0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ans = UsersAnswer::updateOrCreate([
                'user_id' => $userID,
                'question_id' => $answer['question_id'],
                'class_id' => $classId,
                'type_id' => $typeId,
                ],
                [
                'question_id' => $answer['question_id'],
                'option_id' => $answerID,
                'answer' => $ans,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function students($schoolID=0) {
        $questions = Questions::where('id', '>', 17)->where('id', '<=', 21)->with('options')->get();
        $title = ['value' => "শিক্ষার্থী সংক্রান্ত তথ্য (পরিদর্শন তারিখে)", 'url' => "students"];
        // die(var_dump($questions->toArray()));
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $QA = array();
        $schools = School::getById($userID);
        $classes = $schools->classes;
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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
        $message = "Students question found";
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function studentsAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeID = 0;
            if(isset($answer['type_id'])) {
                $typeID = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ans = UsersAnswer::updateOrCreate([
                'user_id' => $userID,
                'question_id' => $answer['question_id'],
                'class_id' => $classId,
                'type_id' => $typeID,
                ],
                [
                'question_id' => $answer['question_id'],
                'option_id' => $answerID,
                'answer' => $ans,
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function teachers($schoolID=0) {
        $allquestions = Questions::where('id', '>', 21)->where('id', '<=', 25)->with('options')->get();
        $title = ['value' => "শিক্ষক সংক্রান্ত  তথ্য", 'url' => "teachers"];
        // die(var_dump($questions->toArray()));
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $QA = array();
        $types = QuestionType::where('id', '>=', 4)->where('id', '<=', 5)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($allquestions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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

        $questions = Questions::where('id', '>', 25)->where('id', '<=', 34)->with('options')->get();
        $QAA = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();

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
            array_push($QAA, $qa);
        }
        $qa = ['type' => "প্রশিক্ষণ সংক্রান্ত তথ্য ", "questions" => $QAA];
        array_push($QA, $qa);
        $message = "Teachers question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function teachersAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);

    }
    public function lectures($schoolID=0) {
        $allquestions = Questions::where('id', '>', 34)->where('id', '<=', 45)->with('options')->get();
        $title = ['value' => "শ্রেণী পাঠদান পর্যবেক্ষণ (নূন্যতম দুটি ক্লাস পর্যবেক্ষণ করে শ্রেণীর তথ্য পূরণ করুন)", 'url' => "lectures"];
        $QA = array();
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $schools = School::getById($userID);
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($allquestions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
                            "created_at" => "",
                            "updated_at" => ""
                        ];
                    };
                }
                $qa['answer'] = $opt;
                array_push($qs, $qa);
            }
            $cl['questions'] = $qs;

            $questions = Questions::where('id', '>', 45)->where('id', '<=', 48)->with('options')->get();
            $QAA = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();

                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
                            "created_at" => "",
                            "updated_at" => ""
                        ];
                    }

                }
                $qa['answer'] = $opt;
                array_push($QAA, $qa);
            }
            $qa = ['title' => "বিগত এক মাসে ইংরেজি, গণিত ও বিজ্ঞান বিষয়ে কতগুলি অতিরিক্ত ক্লাস নেয়া হয়েছে?", "questions" => $QAA];
            $cl['inner'] = $qa;
            array_push($QA, $cl);
            //array_push($QA, $qa);
        }

        $message = "Lecture question found";
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function lecturesAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function multimedia($schoolID = 0) {
        $allquestions = Questions::where('id', '>', 48)->where('id', '<=', 50)->with('options')->get();
        $title = ['value' => "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )", 'url' => "multimedia"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $schools = School::getById($userID);
        $classes = $schools->classes;
        //$classes = $classes->toArray();
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($allquestions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
                            "created_at" => "",
                            "updated_at" => ""
                        ];
                    }
                }
                $qa['answer'] = $opt;
                array_push($qs, $qa);
            }
            $cl['questions'] = $qs;

            $questions = Questions::where('id', '>', 51)->where('id', '<=', 55)->with('options')->get();
            $QAA = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();

                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
                            "created_at" => "",
                            "updated_at" => ""
                        ];
                    }

                }
                $qa['answer'] = $opt;
                array_push($QAA, $qa);
            }
            $qa = ['title' => "ডিজিটাল কন্টেন্ট", "questions" => $QAA];
            $cl['inner'] = $qa;
            array_push($QA, $cl);
        }

        $message = "Lecture question found";
        $form = array("title"=>$title, "classes" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function multimediaAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function yearlyplan($schoolID=0) {
        $questions = Questions::where('id', '>', 55)->where('id', '<=', 59)->with('options')->get();
        $title = ['value' => "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য", 'url' => "multimedia"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $schools = School::getById($userID);
        $classes = $schools->classes;
        $qs = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();
            $opt = array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;
            array_push($QA, $qa);
        }


        $message = "Yearly plan question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function yearlyplanAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function diary($schoolID=0) {
        $questions = Questions::where('id', '=', 60)->with('options')->get();
        $title = ['value' => "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য", 'url' => "diary"];
       // die(var_dump($question->id));
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $QA = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', 60)->first();
            $opt = array();
            $qs  = array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;
            array_push($qs, $qa);
            $cl['questions'] = $qs;

            array_push($QA, $cl);
        }

        $questions = Questions::where('id', '=', 61)->with('options')->get();
        $types = QuestionType::where('id', '>=', 7)->where('id', '<=', 9)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
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

        $questions = Questions::where('id', '=', 62)->with('options')->get();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', 62)->first();
            $opt = array();
            $qs=array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;
            array_push($qs, $qa);
            $bl['questions'] = $qs;
            array_push($QA, $bl);
        }

        $message = "Diary question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function diaryAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function study($schoolID=0) {
        $questions = Questions::where('id', '>', 62)->where('id', '<=', 64)->with('options')->get();
        $title = ['value' => "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা", 'url' => "study"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
       $schools = School::getById($userID);
        $classes = $schools->classes;
        $qs = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();
            $opt = array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;
            //array_push($qs, $qa);
            array_push($QA, $qa);
            //
        }
        //$cl['questions'] = $qs;
        $message = "study plan question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function overallAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }
        if($request->has('school_id')) {
            $userID = $request->get('school_id');
        }else {
            $userID = $this->school->id;
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
            $classId= 0;
            $typeId=0;
            if(isset($answer['type_id'])) {
                $typeId = $answer['type_id'];
            }
            if(isset($answer['class_id'])) {
                $classId = $answer['class_id'];
            }
            $ua = UsersAnswer::updateOrCreate(
                [
                    'user_id' => $userID,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'question_id' => $answer['question_id'],
                    'option_id' => $answerID,
                    'answer' => $ans,
                    'xtra' => 'education',
                    'answer_date' => Carbon::now()->toDateString()
                ]);
            $ua->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function meetings($schoolID=0) {
        $questions = Questions::where('id', '>', 64)->where('id', '<=', 68)->with('options')->get();
        $title = ['value' => "সভা সংক্রান্ত তথ্য", 'url' => "meetings"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $types = QuestionType::where('id', '>=', 10)->where('id', '<=', 13)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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


        $message = "Meetings question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function extracuriculumn($schoolID=0) {
        $questions = Questions::where('id', '>', 68)->where('id', '<=', 71)->with('options')->get();
        $title = ['value' => "সহ-শিক্ষাক্রমিক কার্যক্রম", 'url' => "extracuriculumn"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $types = QuestionType::where('id', '=', 14)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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


        $message = "Meetings question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function lastbenchers($schoolID=0) {
        $questions = Questions::where('id', '=', 72)->with('options')->get();
        $title = ['value' => "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য", 'url' => "lastbenchers"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', 72)->first();
            $opt = array();
            $qs=array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;
            array_push($QA, $qa);
        }

        $message = "Lastbenchers question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function creative($schoolID = 0) {
        $questions = Questions::where('id', '=', 73)->with('options')->get();
        $title = ['value' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য", 'url' => "creative"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', 73)->first();
            $opt = array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;

            //$cl['questions'] = $qa;
            array_push($QA, $qa);
        }
        $message = "Creative question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function assessment($schoolID = 0) {
        $questions = Questions::where('id', '>', 73)->where('id', '<=', 76)->with('options')->get();
        $title = ['value' => "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য", 'url' => "assessment"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $types = QuestionType::where('id', '=', 15)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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


        $message = "Assesment question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function result($schoolID = 0) {
        $questions = Questions::where('id', '>', 76)->where('id', '<=', 80)->with('options')->get();
        $title = ['value' => "পরীক্ষার ফলাফল সম্পর্কিত তথ্য", 'url' => "result"];
        // die(var_dump($questions->toArray()));
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $schools = School::getById($userID);
        $classes = $schools->classes;
        foreach ($classes as $class) {
            $cl = $class->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('class_id', $class->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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
        $types = QuestionType::where('id', '>=', 16)->where('id', '<=', 17)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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
        $message = "Students question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function academic($schoolID = 0) {
        $questions = Questions::where('id', '>', 80)->where('id', '<=', 83)->with('options')->get();
        $title = ['value' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ", 'url' => "academic"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $types = QuestionType::where('id', '>=', 18)->where('id', '<=', 23)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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


        $message = "Academic question found";
        $form = array("title"=>$title, "types" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function comment($schoolID = 0) {
        $questions = Questions::where('id', '=', 84)->orWhere('id', '=', 98)->with('options')->get();
        $title = ['value' => "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য", 'url' => "comment"];
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->first();
            $opt = array();
            if ($ans != null) {
                if ($ans->option_id != 0) {
                    $opt = Options::where('id', $ans->option_id)->first();
                    $opt = $opt->toArray();
                } else {
                    $opt = [
                        "id" => -1,
                        "option" => "",
                        "option_value" => $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }
            }
            $qa['answer'] = $opt;

            array_push($QA, $qa);
        }
        $message = "Comment question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }

    public function teacherpresent($schoolID = 0) {
        $questions = Questions::where('id', '>', 95)->where('id', '<=', 97)->with('options')->get();
        $title = ['value' => "শিক্ষক উপস্থিতি", 'url' => "teacherpresent"];
        // die(var_dump($questions->toArray()));
        $QA = array();
        $userID=$schoolID;
        if($schoolID==0) {
            $userID = $this->school->id;
        }
        $types = QuestionType::where('id', '>=', 24)->where('id', '<=', 25)->get();
        foreach ($types as $type) {
            $cl = $type->toArray();
            $qs = array();
            foreach ($questions as $question) {
                $qa = $question->toArray();
                $ans = UsersAnswer::where('user_id', $userID)->where('question_id', $question->id)->where('type_id', $type->id)->first();
                $opt = array();
                if ($ans != null) {
                    if ($ans->option_id != 0) {
                        $opt = Options::where('id', $ans->option_id)->first();
                        $opt = $opt->toArray();
                    } else {
                        $opt = [
                            "id" => -1,
                            "option" => "",
                            "option_value" => $ans->answer,
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

    public function getAllQuestions($schoolID) {
        $environment = $this->environment($schoolID);
        $environment = $environment->getData(true);
        $classrooms = $this->classroom($schoolID);
        $classrooms = $classrooms->getData(true);
        $scienceLab = $this->scienceLab($schoolID);
        $scienceLab = $scienceLab->getData(true);
        $students = $this->students($schoolID);
        $students = $students->getData(true);
        $teachers = $this->teachers($schoolID);
        $teachers = $teachers->getData(true);
        $lectures = $this->lectures($schoolID);
        $lectures = $lectures->getData(true);
        $multimedia = $this->multimedia($schoolID);
        $multimedia = $multimedia->getData(true);
        $yearlyplan = $this->yearlyplan($schoolID);
        $yearlyplan = $yearlyplan->getData(true);
        $diary = $this->diary($schoolID);
        $diary = $diary->getData(true);
        $study = $this->study($schoolID);
        $study = $study->getData(true);
        $meetings = $this->meetings($schoolID);
        $meetings = $meetings->getData(true);
        $teacherpresent = $this->teacherpresent($schoolID);
        $teacherpresent = $teacherpresent->getData(true);
        $extracuriculumn = $this->extracuriculumn($schoolID);
        $extracuriculumn = $extracuriculumn->getData(true);
        $lastbenchers = $this->lastbenchers($schoolID);
        $lastbenchers = $lastbenchers->getData(true);
        $creative = $this->creative($schoolID);
        $creative = $creative->getData(true);
        $assessment = $this->assessment($schoolID);
        $assessment = $assessment->getData(true);
        $result = $this->result($schoolID);
        $result = $result->getData(true);
        $academic = $this->academic($schoolID);
        $academic = $academic->getData(true);
        $comment = $this->comment($schoolID);
        $comment = $comment->getData(true);

        $data = [$environment, $classrooms, $scienceLab, $students, $teachers, $lectures,
                $multimedia, $yearlyplan, $diary, $study, $meetings,
                $teacherpresent,$extracuriculumn, $lastbenchers, $creative, $assessment, $result,
                $academic];
        $all = ['form' => $data, 'comment'=> $comment];
        $message = "All question found";
        return response()->json(['success'=>1,'message'=> $message, 'report' => $all]);
    }


}



