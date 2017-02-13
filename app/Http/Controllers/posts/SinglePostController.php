<?php

namespace App\Http\Controllers\posts;


use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\SinglePost;

class SinglePostController extends Controller
{
    public function add(Requests\SinglePostRequest $request) {
        if($request->isMethod('post')) {
            $singlePost = new SinglePost();
            $singlePost->title = $request->get('title');
            $singlePost->type = $request->get('type');
            $singlePost->subtitle = $request->get('sub_title');
            $singlePost->content = $request->get('content');
            $singlePost->save();
            return response()->json(['id' => $singlePost->id,'success'=>1,'message'=>'Post successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update(Requests\SinglePostRequest $request)
    {
        if ($request->method('put')) {
            try {
                $post = SinglePost::where('id', $request->get('id'))->first();
                $post->title = $request->get('title');
                $post->type = $request->get('type');
                $post->subtitle = $request->get('sub_title');
                $post->content = $request->get('content');
                $post->update();
                return response()->json(['id' => $post->id,'success'=>1,'message'=>'Post successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function delete($id)
    {
        $post = SinglePost::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $post->delete();
        return response()->json(['success'=>1,'message'=>'Post successfully deleted']);

    }
}
