<?php

namespace App\Http\Controllers\school;

use App\Http\Requests\SchoolRequest;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class SchoolController extends Controller
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
            $this->middleware('ability:token',['except' => ['index']]);
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

    public function index(Request $request) {
        if($request->isMethod('get')) {
            $schools = School::with('user')->get();
            return response()->json(['success' =>1, 'message'=>'all school list', 'schools'=> $schools]);
        }
    }

    public function category($category) {
        $school = School::with('user')->where('category', 'LIKE', $category.'%')->get();
        return response()->json(['success' =>1, 'message'=> $category. ' schools list', 'schools'=>$school]);
    }

    public function store(SchoolRequest $request) {
        if($request->isMethod('post')) {

            $input = $request->only(['name', 'email', 'password']);
            $input['password'] = bcrypt($request->get('password'));
            $id= User::create($input)->id;

            $user=User::find($id);
            $role = Role::where('name', '=', 'school')->first();
            if($role == null) {
                $role = new Role();
                $role->name = 'school';
                $role->display_name = 'General User';
                $role->description = 'User Priviledges';
                $role->save();
            }
            $user->roles()->attach($role->id);

            $input = $request->except(['name', 'email', 'password']);
            $input['user_id'] = $user->id;
            $input['teacher'] = isset($input['teacher']) ? (int)$input['teacher']: 0;
            $input['female_teacher'] = isset($input['female_teacher']) ? (int)$input['female_teacher']: 0;

            $id = School::create($input)->id;
            $school = School::find($id);
            $school->user_id=$user->id;
            $school->update();

            return response()->json(['id' => $user->id, 'school_id' => $id, 'success'=>1,'message'=>'school successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update($id = null, SchoolRequest $request)
    {
        if ($request->method('put')) {
            try {
                if($id == 'edit') {
                    $school = School::where('user_id', '=', $this->user->id)->first();
                    $id = $school->id;
                }
                if($this->isAdmin) {
                    $school = School::find($id);
                    $userID = $school->user_id;
                } else {
                    $userID = $this->user->id;
                }
                $user = User::find($userID);
                $input = $request->only(['name', 'email', 'password']);
                if(isset($input['password'])) {
                    $user->password= bcrypt($request->get('password'));
                }
                if(isset($input['name'])) {
                    $user->name = $input['name'];
                }
                if(isset($input['email'])) {
                    $user->email = $input['email'];
                }
                $user->update();


                $input = $request->only(['category', 'teacher', 'female_teacher', 'upozilla', 'zilla', 'management', 'type', 'mpo_code', 'mpo_date', 'eiin_number']);
                $input['teacher'] = $input['teacher'] == null || $input['teacher'] == '' ? 0: (int)$input['teacher'];
                $input['female_teacher'] = $input['female_teacher'] == null || $input['female_teacher'] == '' ? 0: (int)$input['female_teacher'];
                School::where('id', $id)->update($input);

                return response()->json(['id' => $id,'success'=>1,'message'=>'school successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function destroy($id)
    {
        $school = School::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $school->delete();
        return response()->json(['success'=>1,'message'=>'school successfully deleted']);

    }
}
