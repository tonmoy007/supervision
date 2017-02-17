<?php

namespace App\Http\Controllers\home;

use App\Models\Gallary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GallaryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $sliders = Gallary::all();
            return response()->json(['success' => 1, 'message' => 'all employee list', 'sliders' => $sliders]);
        }
    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $images = $request->file("images");
            if(!empty($images)) {
                $dir = "gallary";
                if(is_array($images)||is_object($images)){
                    if(is_object($images)) {
                        $images = array($images);
                    }
                    ;
                    foreach ($images as $key => $value)  {
                        $gallary = new Gallary();
                        $file = $images[$key];
                        $path = $images[$key]->store($dir);
                        $gallary->file = Storage::disk('local')->url($path);
                        $gallary->type = $file->getClientMimeType();
                        $gallary->save();
                        return response()->json(['success'=>1,'message'=>'Gallary successfully added']);
                    }
                }

            }

        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);
    }
    public function destroy($id)
    {
        $gallary = Gallary::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $gallary->delete();
        return response()->json(['success'=>1,'message'=>'Employee successfully deleted']);

    }

}
