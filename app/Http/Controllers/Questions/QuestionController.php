<?php

namespace App\Http\Controllers\Questions;

use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index(){
        $menu = [
            "শিক্ষা প্রতিষ্ঠানের  শিখন শেখানো পরিবেশ" => "/api/questions/environments",
            "শ্রেণীকক্ষ সংক্রান্ত তথ্য" => "/api/questions/environments",
            "বিজ্ঞানাগার, কম্পিউটার ল্যাব ও লাইব্রেরী সংক্রান্ত তথ্য ( বিগত মাসের রেকর্ড)" => "/api/questions/environments",
            "শিক্ষক সংক্রান্ত  তথ্য" => "/api/questions/environments",
            "শ্রেণী পাঠদান পর্যবেক্ষণ  ( নূয়নতম দুটি ক্লাস পর্যবেক্ষণ করে শ্রেণির তথ্য পূরণ করুন )" => "/api/questions/environments",
            "মাল্টিমিডিয়া ক্লাসরুম ব্যবহার সংক্রান্ত তথ্য ( বিগত মাসের )" => "/api/questions/environments",
            "পঞ্চবার্ষিক / বার্ষিক উন্নয়ন পরিকল্পনা সংক্রান্ত তথ্য" => "/api/questions/environments",
            "প্রতিষ্ঠান প্রধানের রেজিস্টার ও শিক্ষকের ডায়েরী  সংক্রান্ত তথ্য" => "/api/questions/environments",
            "শ্রেণি পাঠদান পর্যবেক্ষণে প্রতিষ্ঠান প্রধানের ভূমিকা" => "/api/questions/environments",
            "সভা সংক্রান্ত তথ্য" => "/api/questions/environments",
            "সহ-শিক্ষাক্রমিক কার্যক্রম" => "/api/questions/environments",
            "স্বল্প কৃতিধারী শিক্ষার্থীদের চিহ্নিতকরণ   সংক্রান্ত তথ্য" => "/api/questions/environments",
            "সৃজনশীল প্রশ্ন প্রণয়ন পদ্ধতি বাস্তবায়ন বিষয়ক তথ্য" => "/api/questions/environments",
            "ধারাবাহিক মূল্যায়ন (CA) সংক্রান্ত তথ্য" => "/api/questions/environments",
            "পরীক্ষার ফলাফল সম্পর্কিত তথ্য" => "/api/questions/environments",
            "সংশ্লিষ্ট প্রতিষ্ঠানের সার্বিক মানোন্নয়ন পরিদর্শনকারী কর্মকর্তা কর্তিক প্রদত্ত সুপারিশসমুহ" => "/api/questions/environments",
            "পরিদর্শনকারী কর্মকর্তার সার্বিক মন্তব্য" => "/api/questions/environments",
        ];
        $message = "Menue found";
        return response()->json(['success'=>1,'message'=> $message, 'menu' => $menu]);


    }
    public function environment() {
        for($i=1; $i<= 8; $i++) {

        }
        $questions = Questions::where('id', '<=', 8)->with('options')->get();

        //die(var_dump($questions->questions));
        $QA = array();
        foreach ($questions as $question) {
            $qa = $question->toArray();
            $qa['answers'] = array();
            array_push($QA, $qa);
        }
        $message = "Environment question found";
        return response()->json(['success'=>1,'message'=> $message, 'questions' => $QA]);
        die(var_dump($QA));
        die(var_dump($question->toArray()));
        $options = $question->options;
        die(var_dump($options->toArray()));
    }
}
