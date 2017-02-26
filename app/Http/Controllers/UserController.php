<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SuperVision;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;
use Session;
use Validator;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $user['role']=$user->roles->first()['name'];
        $users=User::all();
        foreach ($users as $key => $value) {
            $value->roles->first()['name'];
        }
        $message=(count($users)>0)?'User found':'No user found';
        return response()->json(['users'=>$users,'success'=>1,'message'=>$message]);
    }
     public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['type' => 'invalid_credentials','success'=>0,'message'=>'Invalid Credentials']);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['type' => 'could_not_create_token','success'=>0,'message'=>'Could no create token']);
        }
        
        // if no errors are encountered we can return a JWT
        $user_info=User::get()->where('email',$request->input('email'))->first();
        $user_info['role']=$user_info->hasRole('admin')?'admin':'general_user';
        $access_token=JWTAuth::fromUser($user_info);
        // $token=new Token();
        // $token->token=$access_token;
        // $supervision=new SuperVision();
        // $token->expired_on=$supervision->getDateTime();
        // $user_info->tokens()->save($token);
        // $token->save();
        $user_info->token=$access_token;
        return response()->json(['user_info'=>$user_info,'success'=>1,'message'=>'Successfully Logged in']);
    }
    public function assignRole(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return $user;
    }
    public function createRole(Request $request){

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json("created");

    }
    public function checkRoles(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();
        Log::info($user);
        return response()->json([
            "user" => $user,
            "owner" => $user->hasRole('general_user'),
            "admin" => $user->hasRole('admin'),
        ]);
    }
    public function logout(Request $request){
        

        $success = JWTAuth::invalidate(JWTAuth::getToken());

        
         //   JWTAuth::invalidate($request->token);
            Auth::logout();

        
        
        return response()->json(['success'=>(int)$success,'message'=>'Successfully logged out']);

    }

    public function user(Request $request){
        $validator=Validator::make($request->all(),['user_id'=>'required']);
        $response=[];
        if($validator->fails()){
            $errors=$validator->errors();
            return response()->json(['message'=>$errors->all(),'success'=>0,'type'=>'validation_error']);
        }

        $response['user']=User::find($request->user_id);
        if($response['user']!=null){
            $response['user']['role']=$response['user']->roles()->first()->name;
            $response['success']=1;
            $response['message']='user found';
        }else{
            $response['success']=0;
            $respons['message']='User not found';
        }
        return response()->json($response);
    }
}

