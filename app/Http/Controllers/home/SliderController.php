<?php

namespace App\Http\Controllers\home;

use App\Models\Link;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request) {
        if($request->isMethod('get')) {
            $sliders = Slider::all();
            return response()->json(['success' =>1, 'message'=>'all employee list', 'sliders'=>$sliders]);
        }
    }
    public function store(Request $request) {
        if($request->isMethod('post')) {
            $images = $request->file("images");
            if(!empty($images)) {
                $dir = "sliders";
                foreach ($images as $key => $value) {
                    $slider = new Slider();
                    $slider->description = $request->get('description');
                    $path = $request->images[$key]->store($dir);
                    $slider->image = Storage::disk('local')->url($path);
                    $slider->save();
                }
            }
            return response()->json(['success'=>1,'message'=>'Employee successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function destroy($id)
    {
        $link = Link::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $link->delete();
        return response()->json(['success'=>1,'message'=>'Employee successfully deleted']);

    }
}
