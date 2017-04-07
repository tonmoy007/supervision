<?php

namespace App\Http\Controllers\Questions;

use App\Models\UsersAnswer;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
class ReportController extends Controller
{
    public function testReport() {
      //  $p = new PDF();
        $pdf = PDF::loadView('report.test', array());
        return $pdf->download('test.pdf');
    }
    /*protected $user;
    public function __construct(Request $request)
    {
        $method = $request->method();
        /*if($method != 'post') {
            return;
        }//
        try {
            $this->middleware('ability:token',['except' => ['index']]);
            $this->user = JWTAuth::parseToken()->toUser();
        }catch (TokenExpiredException $e) {
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            $this->user = JWTAuth::setToken($newToken)->toUser();
        }
    }*/
    public function index(){
        $menu = [
            ['title' => "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ", 'url' => "environments"],
            ['title' => "ক্লাস্টারের দায়িত্বপ্রাপ্ত কর্মকর্তাগণের তথ্য", 'url' => "responsibility"],
            ['title' => "কর্মকর্তাগণের বদলি এবং ক্লাস্টার পরিবর্তনের বিবরণ", 'url' => "transfer"],
            ['title' => "ভৌত অবকাঠামোগত সুবিধাবঞ্চিত প্রতিষ্ঠানসমূহের তথ্য (সংখ্যা)", 'url' => "infrastructure"],
            ['title' => " রিপোর্টিং মাসে পিবিএম বাস্তবায়ন সংক্রান্ত তথ্য", 'url' => "pbm"],
            ['title' => " পঞ্চবার্ষিক / বার্ষিক উন্নয়ন সংক্রান্ত তথ্য", 'url' => "yearly"],
            ['title' => "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )", 'url' => "multimedia"],
            ['title' => "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য", 'url' => "yearlyplan"],
            ['title' => "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য", 'url' => "diary"],
            ['title' => "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা", 'url' => "study"],
            ['title' => "সভা সংক্রান্ত তথ্য", 'url' => "meetings"],
            ['title' => "সহ-শিক্ষাক্রমিক কার্যক্রম", 'url' => "extracuriculumn"],
            ['title' => "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য", 'url' => 'lastbenchers'],
            ['title' => "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য", 'url' => "creative"],
            ['title' => "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য", 'url' => "assessment"],
            ['title' => "পরীক্ষার ফলাফল সম্পর্কিত তথ্য", 'url' => "result"],
            ['title' => "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ", 'url' => "academic"],
            ['title' => "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য", 'url' => "comment"],
        ];
        $message = "Menue found";
        return response()->json(['success'=>1,'message'=> $message, 'menu' => $menu]);
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
