<?php

namespace App\Http\Controllers\home;

use App\Models\Employee;
use App\Models\Link;
use App\Models\SinglePost;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request) {
        $sliders = Slider::all();

        $aboutUs = SinglePost::where('type', 'LIKE', "আমাদের সম্পর্কে")->get();
        $employee = Employee::select('designation')->distinct()->get();
        $education = SinglePost::where('type', 'LIKE', "শিক্ষা অফিসের কার্যক্রম")->get();
        $digital = SinglePost::where('type', 'LIKE', "ডিজিটাল সেবা সমূহ")->get();
        $contact = SinglePost::where('type', 'LIKE', "যোগাযোগ")->get();

        $menue = ["আমাদের সম্পর্কে" => array_merge($aboutUs->toArray(), $employee->toArray()),
            'শিক্ষা অফিসের কার্যক্রম' =>$education->toArray(), 'ডিজিটাল সেবা সমূহ' =>$digital->toArray(),
            "যোগাযোগ" => $contact->toArray()];

        $gk = SinglePost::where('type', 'LIKE', "সাধারন তথ্য")->get();


        $bani = SinglePost::where('type', 'LIKE', "বানী")->get();
        $khobor = SinglePost::where('type', 'LIKE', "খবর")->get();
        $links  = Link::get()->groupBy(function($link){ return $link->type; });
        $sidebar = ["বানী" => $bani->toArray(), "খবর" => $khobor->toArray(), "links"=> $links];

        return response()->json(['success'=>1,'message'=>'found all','menue'=> $menue,
           'sliders'=>$sliders, 'information' => $gk, 'sidebar' => $sidebar]);

    }

    public function menu() {
        $sliders = Slider::all();

        $aboutUs = SinglePost::where('type', 'LIKE', "আমাদের সম্পর্কে")->get();
        $employee = Employee::select('designation')->distinct()->get();
        $education = SinglePost::where('type', 'LIKE', "শিক্ষা অফিসের কার্যক্রম")->get();
        $digital = SinglePost::where('type', 'LIKE', "ডিজিটাল সেবা সমূহ")->get();
        $contact = SinglePost::where('type', 'LIKE', "যোগাযোগ")->get();

        $menue = ["আমাদের সম্পর্কে" => array_merge($aboutUs->toArray(), $employee->toArray()),
            'শিক্ষা অফিসের কার্যক্রম' =>$education->toArray(), 'ডিজিটাল সেবা সমূহ' =>$digital->toArray(),
            "যোগাযোগ" => $contact->toArray()];
        return response()->json(['success'=>1,'message'=>'found menu and sliders','menu'=> $menue, 'sliders'=>$sliders]);
    }

    public function sidebar() {
        $bani = SinglePost::where('type', 'LIKE', "বানী")->get();
        $khobor = SinglePost::where('type', 'LIKE', "খবর")->take(5)->get();
        $links  = Link::get()->groupBy(function($link){ return $link->type; });
        $sidebar = ["বানী" => $bani->toArray(), "খবর" => $khobor->toArray(), "links"=> $links];

        return response()->json(['success'=>1,'message'=>'found sidebar','sidebar'=> $sidebar]);
    }

    public function information() {
        $gk = SinglePost::where('type', 'LIKE', "সাধারন তথ্য")->get();
        return response()->json(['success'=>1,'message'=>'found information', 'information' => $gk]);
    }
}
