<?php

namespace App\Http\Controllers\Questions;

use App\Models\SarventQuestion;
use App\Models\UsersAnswer;
use App\Models\Questions;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function testReport() {
      // $p = new PDF();
        $pdf = PDF::loadView('report.test', array());
        return $pdf->download('test.pdf');
    }
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

    public function general() {
        $questions = Questions::where('id', '>=', 85)->where('id', '<=', 92)->with('options')->get();

        //die(var_dump($questions->questions));
        $title = ['value' => "সাধারণ তথ্য", 'url' => "general"];

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
                        "option_value"=> $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }

            }
            $qa['answer'] = $opt;
            array_push($QA, $qa);
        }
        $message = "General question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function allAnswer(Request $request) {
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
                    'user_id' => $this->user->id,
                    'question_id' => $answer['question_id'],
                    'class_id' => $classId,
                    'type_id' => $typeId,
                ],
                [
                    'user_id' => $this->user->id,
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

    public function responsibility() {
        $answer = SarventQuestion::where('user_id', $this->user->id)->get();
        //$questions =
        $title = ['value'=>' ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তাগণের তথ্যঃ', 'url'=>'responsibility'];
        $form = array("title"=>$title, "questions" => $answer->toArray());
        return response()->json(['success'=>1,'message'=> 'Responsibility questions found', 'form' => $form]);
    }

    public function responsibilityAnswer(Request $request) {
        $answers = $request->get('answers');
        if(!is_array($answers)) {
            $answers = json_decode($answers, true);
        }

        foreach ($answers as $answer) {
            $isDelete = 0;
            if(isset($answer['is_delete'])){
                $isDelete = $answer['is_delete'];
            }
            if($isDelete==1 || $isDelete=='1') {

            }else {
                $ua = SarventQuestion::updateOrCreate(
                    [
                        'user_id' => $this->user->id,
                        'ক্রমিক নং' => $answer['ক্রমিক নং'],
                    ],
                    [
                        'ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তার নাম ও পদবী' => $answer['ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তার নাম ও পদবী'],
                        'ক্লাস্টার ভুক্ত মোট শিক্ষা প্রতিষ্ঠানের সংখ্যা' => $answer['ক্লাস্টার ভুক্ত মোট শিক্ষা প্রতিষ্ঠানের সংখ্যা'],
                        'রিপোর্টিং মাসে পরিদর্শণকৃত শিক্ষা প্রতিষ্ঠানের সংখ্যা' => $answer['রিপোর্টিং মাসে পরিদর্শণকৃত শিক্ষা প্রতিষ্ঠানের সংখ্যা'],
                    ]);
                $ua->save();
            }
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);
    }

    public function transfer() {
        $questions = Questions::where('id', '>=', 93)->where('id', '<=', 95)->with('options')->get();

        //die(var_dump($questions->questions));
        $title = ['value' => "কর্মকর্তাগণের বদলি এবং ক্লাস্টার পরিবর্তনের বিবরণ", 'url' => "transfer"];

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
                        "option_value"=> $ans->answer,
                        "created_at" => "",
                        "updated_at" => ""
                    ];
                }

            }
            $qa['answer'] = $opt;
            array_push($QA, $qa);
        }
        $message = "Transfer question found";
        $form = array("title"=>$title, "questions" => $QA);
        return response()->json(['success'=>1,'message'=> $message, 'form' => $form]);
    }
    public function infrastructure() {
        $wall = UsersAnswer::where('question_id', 1)->where('option_id', 2)->count();
        $toilet = UsersAnswer::where('question_id', 8)->where('option_id', 8)->count();
        $water = UsersAnswer::where('question_id', 9)->where('option_id', 11)->count();
        $class = UsersAnswer::where('question_id', 4)->where('option_id', 2)->count();

        $data = ['data' =>[$wall, $toilet, $water, $class]];

        $pdf = PDF::loadView('report.infrastructure', $data);
        return $pdf->download('infrastructure.pdf');

    }
}
