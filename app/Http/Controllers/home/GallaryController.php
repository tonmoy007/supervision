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
            $gallaries = Gallary::all();
            $images = Gallary::where('type', 'like', "image%")->get();
            $videos = Gallary::where('type', 'like', "video%")->get();
            return response()->json(['success' => 1, 'message' => 'all employee list',
                'gallaries' => $gallaries, 'images' => $images, 'videos' => $videos]);
        }
    }

    public function show($type) {
        $gallaries = Gallary::where('type', 'like', $type."%")->get();
        return response()->json(['success' => 1, 'message' => 'all employee list', 'gallaries' => $gallaries]);

    }
    public function store(Request $request) {
        if($request->isMethod('post')) {
            $images = $request->file("images");
            if(!empty($images)) {
                $dir = "public/gallary";

                if(is_array($images)||is_object($images)){
                    if(is_object($images)) {
                        $images = array($images);
                    }

                    foreach ($images as $key => $value)  {
                        $gallary = new Gallary();
                        $file = $images[$key];
                        $type = explode("/", $file->getClientMimeType());
                        if($type[0] != "image" && $type[0] != "video")
                        {
                            return response()->json(['success'=>0,'message'=> $type[0].' is not allowed']);
                        }
                        $path = $request->images[$key]->store($dir);
                        $gallary->file = Storage::url($path);

                        $gallary->type = $type[0];
                        $gallary->save();
                    }
                    return response()->json(['success'=>1,'message'=>'Gallary successfully added']);
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
