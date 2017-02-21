<?php

namespace App\Http\Controllers\posts;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinglePost;
use Auth;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class SinglePostController extends Controller
{
    protected $user;
    protected $isAdmin;
    public function __construct(Request $request)
    {
        $method = $request->method();
        if($method== "GET") {
            return;
        }
        try {
            $this->middleware('ability:token',['except' => ['index', 'show']]);
            $this->user = JWTAuth::parseToken()->toUser();
        }catch (TokenExpiredException $e) {
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            $this->user = JWTAuth::setToken($newToken)->toUser();
        }

    }
    public function index(Request $request) {
        if($request->isMethod('get')) {
            $posts = SinglePost::all()->groupBy(function($post){ return $post->type; });
            return response()->json(['success' =>1, 'message'=>'all posts list', 'posts'=>$posts]);
        }
    }

    public function category($category) {
        $post = SinglePost::where('type', 'LIKE', $category.'%')->get();
        return response()->json(['success' =>1, 'message'=> $category. ' posts list', 'posts'=>$post]);
    }

    public function show($id) {
        $post = SinglePost::find($id);
        return response()->json(['success' =>1, 'message'=>'all posts list', 'posts'=>$post]);
    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $path="";
            if($request->file("featured_image")) {
                $dir = "public/posts";
                $path = $request->file('featured_image')->store($dir);
            }
            $singlePost = new SinglePost();
            $singlePost->title = $request->get('title');
            $singlePost->type = $request->get('type');
            $singlePost->sub_title = $request->get('sub_title');
            $singlePost->content = $request->get('content');
            $singlePost->featured_image = Storage::url($path);
            $singlePost->user_id = $this->user->id;
            $singlePost->save();
            return response()->json(['id' => $singlePost->id,'success'=>1,'message'=>'Post successfully added', 'path'=>$singlePost->featured_image]);
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
                $post->sub_title = $request->get('sub_title');
                $post->content = $request->get('content');
                if($request->file("featured_image")) {
                    $dir = "posts";
                    $path = $request->file('featured_image')->store($dir);
                    $post->featured_image = Storage::disk('local')->url($path);
                }
                $post->update();
                return response()->json(['id' => $post->id,'success'=>1,'message'=>'Post successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function destroy($id)
    {
        $post = SinglePost::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $post->delete();
        return response()->json(['success'=>1,'message'=>'Post successfully deleted']);

    }
}
