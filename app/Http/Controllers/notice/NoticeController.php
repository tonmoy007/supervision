<?php

namespace App\Http\Controllers\notice;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index() {

    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $notice = new Notice();
            $notice->title = $request->get('title');
            $notice->description = $request->get('description');
            $notice->notice_file = "lol";
            $notice->save();
            if($request->file("notice_file")) {
                $dir = "public/notice/".$notice->id;
                $path = $request->file('notice_file')->store($dir);
                $notice->notice_file = Storage::url($path);
                $notice->update();
            }
            return response()->json(['id' => $notice->id,'success'=>1,'message'=>'Notice successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);

    }

    public function update($id, Request $request)
    {
        if ($request->method('put')) {
            try {
                $notice = Notice::where('id', $id)->first();
                $notice->title = $request->get('title');
                $notice->description = $request->get('description');
                if($request->file("notice_file")) {
                    $dir = "public/notice/".$notice->id;
                    $path = $request->file('notice_file')->store($dir);
                    $notice->notice_file = Storage::url($path);
                }
                $notice->update();
                return response()->json(['id' => $notice->id,'success'=>1,'message'=>'Notice successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function destroy($id)
    {
        $notice = Notice::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $notice->delete();
        return response()->json(['success'=>1,'message'=>'Employee successfully deleted']);

    }

}
