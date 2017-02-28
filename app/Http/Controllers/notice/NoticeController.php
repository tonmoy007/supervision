<?php

namespace App\Http\Controllers\notice;

use App\Models\Notice;
use App\Models\NoticeSeen;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class NoticeController extends Controller
{
    protected $user;
    protected $isAdmin;
    public function __construct(Request $request)
    {
        $method = $request->method();

        try {
            $this->middleware('ability:token');
            $this->user = JWTAuth::parseToken()->toUser();
        }catch (TokenExpiredException $e) {
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            $this->user = JWTAuth::setToken($newToken)->toUser();
        }
        $this->isAdmin = true;
        if($this->user->roles->first()['name'] != 'admin') {
            $this->isAdmin = false;
            $this->middleware('admin', ['only' => ['store']]);
        }

    }
    public function index() {
        $notice = Notice::all();
        if(!$this->isAdmin) {
            NoticeSeen::where('user_id', $this->user->id)->delete();
        }
        return response()->json(['success'=>1,'message'=>'Notice successfully added', 'notices' => $notice]);
    }

    public function newNotice() {
        if(!$this->isAdmin) {
            $seenNotice = NoticeSeen::where('user_id', $this->user->id)->where('is_seen', false)->select('notice_id')->count();
            /*$notices = Notice::whereNotIn('id', $seenNotice)->select('id')->count();
            if($notices>0){

            }*/
            $newNotice = false;
            $message = "No new notice found";
            if($seenNotice > 0) {
                $newNotice = true;
                $message = "New notice found";
            }
            return response()->json(['success'=>1,'message'=> $message, 'new' => $newNotice, 'notice_count' => $seenNotice]);
        }
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
            $users = User::all();
            foreach ($users as $user) {
                //if($user->roles->first()['name']!='admin')
                if($user->id != $this->user->id) {
                    $noticeSeen = new NoticeSeen();
                    $noticeSeen->user_id= $user->id;
                    $noticeSeen->notice_id= $notice->id;
                    $noticeSeen->is_seen = false;
                    $noticeSeen->save();
                }
            }
            return response()->json(['id' => $notice->id,'success'=>1,'message'=>'Notice successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);

    }
    public function show($id) {
        $notice = Notice::find($id);
        return response()->json(['success'=>1,'message'=>'Notice found', 'notice' => $notice]);
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
        return response()->json(['success'=>1,'message'=>'Notice successfully deleted']);

    }

}
