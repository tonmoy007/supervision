<?php

namespace App\Http\Controllers\home;

use App\Models\Link;
use App\Models\SinglePost;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request) {
        $sliders = Slider::all();
        $links  = Link::all();
        $posts = SinglePost::all();

        return response()->json(['success'=>1,'message'=>'found all', 'sliders' => $sliders, 'links' => $links, 'posts' => $posts]);

    }
}
