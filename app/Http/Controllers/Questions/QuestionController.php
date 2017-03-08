<?php

namespace App\Http\Controllers\Questions;

use App\Models\Options;
use App\Models\Questions;
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
            ['title' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "/api/questions/environments"],
            ['title' => "শ্রেণীকক্ষ সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)", 'url' => "/api/questions/environments"],
            ['title' => "শিক্ষক সংক্রান্ত  তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "শ্রেণী পাঠদান পর্যবেক্ষণ  ( নূয়নতম দুটি ক্লাস পর্যবেক্ষণ করে শ্রেণির তথ্য পূরণ করুন )", 'url' => "/api/questions/environments"],
            ['title' => "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )", 'url' => "/api/questions/environments"],
            ['title' => "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা", 'url' => "/api/questions/environments"],
            ['title' => "সভা সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "সহ-শিক্ষাক্রমিক কার্যক্রম", 'url' => "/api/questions/environments"],
            ['title' => "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "পরীক্ষার ফলাফল সম্পর্কিত তথ্য", 'url' => "/api/questions/environments"],
            ['title' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ", 'url' => "/api/questions/environments"],
            ['title' => "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য", 'url' => "/api/questions/environments"],
        ];
        $message = "Menue found";
        return response()->json(['success'=>1,'message'=> $message, 'menu' => $menu]);


    }
    public function environment() {
        for($i=1; $i<= 8; $i++) {

        }
        $questions = Questions::where('id', '<=', 8)->with('options')->get();

        //die(var_dump($questions->questions));
        $title = ['value' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "/api/questions/environments"];

        $QA = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $ans = UsersAnswer::where('user_id', $this->user->id)->where('question_id', $question->id)->first();

            $opv=-1;
            if($ans != null) {
                $opt = Options::where('id', $ans->option_id)->first();

                $opv =  $opt->option_value;
            }
            $qa['answer'] = $opv;
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
            $ans = new UsersAnswer([
                'user_id' => $this->user->id,
                'question_id' => $answer['question_id'],
                'option_id' => $answer['answer_id'],
                'answer' => $answer['answer'],
                'xtra' => 'education',
                'answer_date' => Carbon::now()->toDateString()
            ]);
            $ans->save();
        }
        return response()->json(['success'=>1,'message'=> "answer submitted",]);

    }
}
