<?php

namespace App\Http\Controllers\school;

use App\Models\Classes;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
class ClassController extends Controller
{
    protected $user;
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

    }

    public function index(Request $request) {
        $userID = $this->user->id;
        $roles = User::find($userID)->roles;
        $isAttendanceTaken = false;
        if($roles[0]->name == "general_user") {
            $schools = User::find($userID)->schools;
            $classes = $schools->classes;
            $today = Carbon::now()->toDateString();
            $isAttendanceTaken = School::where('id','=',$schools->id)->whereHas('classes', function($query) use ($today) {
                $query->whereHas('attendances', function ($query) use ($today){
                    $query->where('present_date', $today);
                });
            })->count();
            if($isAttendanceTaken >0 ) {
                $isAttendanceTaken = true;
            }
        } else {
            $id = $request->get('school_id');
            $schools= School::find($id);
            $classes = $schools->classes;

        }
        return response()->json(['success' =>1, 'isAttendanceTaken'=> $isAttendanceTaken, 'message'=>'all class list for '. $schools->name, 'classes'=> $classes]);
    }

    public function store(Request $request) {
        if($request->isMethod('post')) {
            $input = $request->only(['name', 'total_students', 'school_id']);
            if(isset($input['school_id'])) {
                $input['school_id'] = $request->get('school_id');
            }else {
                $userID = $this->user->id;
                $schools = User::find($userID)->schools;
                $input['school_id'] = $schools->id;
            }
            $id = Classes::create($input)->id;
            return response()->json(['id' => $id,'success'=>1,'message'=>'Class successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);
    }

    public function update($id, Request $request) {
        try {
            $input = $request->only(['name', 'total_students']);
            Classes::where('id', '=', $id)->update($input);
            return response()->json(['id' => $id,'success'=>1,'message'=>'class successfully updated']);
        } catch (Exception $e) {
            return response()->json(['success'=>0,'message'=>'update error']);

        }
    }

    public function destroy($id)
    {
        $class = Classes::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $class->delete();
        return response()->json(['success'=>1,'message'=>'class successfully deleted']);

    }


}
