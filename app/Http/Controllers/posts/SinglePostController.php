<?php

namespace App\Http\Controllers\posts;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinglePost;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class SinglePostController extends Controller
{
    public function all(Request $request) {
        if($request->isMethod('get')) {
            $posts = SinglePost::all()->groupBy(function($post){ return $post->type; });
            return response()->json(['success' =>1, 'message'=>'all posts list', 'posts'=>$posts]);
        }
    }
    public function add(Request $request) {
        if($request->isMethod('post')) {
            if($request->file("featured_image")) {
                $file = $request->file('featured_image');
                $extension = $file->getClientOriginalExtension();
                Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                //$dir = "posts";//.$singlePost->id;
               // $path = $request->file('featured_image')->store($dir);
               // $path = Storage::put($request->file('featured_image'),'public');
            }
            $singlePost = new SinglePost();
            $singlePost->title = $request->get('title');
            $singlePost->type = $request->get('type');
            $singlePost->subtitle = $request->get('sub_title');
            $singlePost->content = $request->get('content');
            $singlePost->featured_image = asset($path);
            $singlePost->save();
            return response()->json(['id' => $singlePost->id,'success'=>1,'message'=>'Post successfully added', 'path'=>asset($path)]);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update($id, Request $request)
    {
        if ($request->method('put')) {
            try {
                $post = SinglePost::where('id', $id)->first();
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
