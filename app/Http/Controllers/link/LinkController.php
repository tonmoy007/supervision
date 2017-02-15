<?php

namespace App\Http\Controllers\link;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function all(Request $request) {
        if($request->isMethod('get')) {
            $links = Link::all()->groupBy(function($link){ return $link->type; });
            return response()->json(['success' =>1, 'message'=>'all employee list', 'links'=>$links]);
        }
    }
    public function add(Request $request) {
        if($request->isMethod('post')) {
            $link = new Link();
            $link->name = $request->get('name');
            $link->type = $request->get('type');
            $link->url = $request->get('url');
            $link->save();
            return response()->json(['id' => $link->id,'success'=>1,'message'=>'Link successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update($id, Request $request)
    {
        if ($request->method('put')) {
            try {
                $link = Link::where('id', $id)->first();
                $link->name = $request->get('name');
                $link->type = $request->get('type');
                $link->url = $request->get('url');
                $link->update();
                return response()->json(['id' => $link->id,'success'=>1,'message'=>'link successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function delete($id)
    {
        $link = Link::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $link->delete();
        return response()->json(['success'=>1,'message'=>'Employee successfully deleted']);

    }
}
