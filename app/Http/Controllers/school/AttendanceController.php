<?php

namespace App\Http\Controllers\school;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AttendanceController extends Controller
{
    protected $user;
    protected $isAdmin;
    public function __construct(Request $request)
    {
        $method = $request->method();
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
        //    $this->middleware('admin', ['only' => ['store']]);
        }
    }
    public function index(Request $request) {
        $today = Carbon::now()->toDateString();
        //$classes = School::find($this->user->id)->classes->attendances;//->groupBy(function($classes){ return $classes->attendances; });
        $attendance = Classes::find(1)->attendances;
        die(var_dump($attendance->toArray()));
    }

    public function schoolHistory($id=null) {
        $today = Carbon::now()->toDateString();
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->only(['present_students', 'present_date']);
            if (!isset($input['present_date'])) {
                $input['present_date'] = Carbon::now()->toDateString();
            }
            $class = Classes::find($request->get('classes_id'));
            $input['present_by'] = $this->user->id;
            $attendance = Attendance::firstOrNew([
                'present_date' =>$input['present_date'],
                'classes_id' => $request->get('classes_id')
            ]);
            $attendance->present_students = $input['present_students'];
            $attendance->present_by = $input['present_by'];
           // $id = $attendance->save()->id;
            $id = $class->attendances()->save($attendance)->id;
            return response()->json(['id' => $id,'success'=>1,'message'=>'Attendance successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);

    }
}

/*
 * if ($request->isMethod('post')) {
            $input = $request->only(['present_students', 'present_date']);
            if (!isset($input['present_date'])) {
                $input['present_date'] = Carbon::now()->toDateString();
            }
            $class = Classes::find($request->get('classes_id'));
            $input['present_by'] = $this->user->id;

            $attendance = Attendance::firstOrNew([
                'present_students' =>$input['present_students'],
                'classes_id' => $request->get('class_id')
            ]);
            $attendance->present_date = $input['present_date'];
            $attendance->present_by = $input['present_by'];

            //$id = $attendance->save();
            $id = $class->attendances()->save($attendance)->id;
            return response()->json(['id' => $id,'success'=>1,'message'=>'Attendance successfully added']);
        }
 */