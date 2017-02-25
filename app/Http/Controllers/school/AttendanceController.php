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
    public function index() {
        $totalStudents = School::find($this->user->id)->classes->sum('total_students');
        $today = Carbon::now()->toDateString();
       // $classes = School::with('classes.attendances')->where('id', '=', $this->user->id)->get(); //find($this->user->id)->classes()->getAttendance();//->groupBy(function($classes){ return $classes->attendances; });
        $classes = School::find($this->user->id)->classes;
        $attendances = array();
        $presentStudents = 0;
        foreach ($classes as $class) {
            $attendance = $this->getAttandance($class->id, $today);
            if(sizeof($attendance) >0) {
                $presentStudents += $attendance[0]['present_students'];
            }
            $attendances = array_merge($attendances,  $attendance);
        }
        return response()->json(['success'=>1,'message'=>'Attendance successfully added',
                            'total_students' => $totalStudents, 'present_students' => $presentStudents,
                            'absent_students' => $totalStudents- $presentStudents, 'attendance' => $attendances    ]);
    }

    public function show($id) {
        $totalStudents = School::find($id)->classes->sum('total_students');
        $today = Carbon::now()->toDateString();
        // $classes = School::with('classes.attendances')->where('id', '=', $this->user->id)->get(); //find($this->user->id)->classes()->getAttendance();//->groupBy(function($classes){ return $classes->attendances; });
        $classes = School::find($id)->classes;
        $attendances = array();
        $presentStudents = 0;
        foreach ($classes as $class) {
            $attendance = $this->getAttandance($class->id, $today);
            if(sizeof($attendance) >0) {
                $presentStudents += $attendance[0]['present_students'];
            }
            $attendances = array_merge($attendances,  $attendance);
        }
        return response()->json(['success'=>1,'message'=>'Attendance successfully added',
            'total_students' => $totalStudents, 'present_students' => $presentStudents,
            'absent_students' => $totalStudents- $presentStudents, 'attendance' => $attendances    ]);
    }

    private function getAttandance($classID, $date) {
        $attendance = Classes::find($classID)->attendances()->where('present_date', $date)->get();
        return $attendance->toArray();
    }

    public function schoolHistory($id=null) {
        $today = Carbon::now()->toDateString();
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->only(['attendance', 'present_date']);
            if (!isset($input['present_date'])) {
                $input['present_date'] = Carbon::now()->toDateString();
            }
            $presentInfo = $input['attendance'];
            if(!is_array($presentInfo)) {
                $presentInfo = json_decode($presentInfo, true);
            }

            foreach ($presentInfo as $pi) {
                $class = Classes::find($pi['class_id']);
                $attendance = Attendance::firstOrNew([
                    'present_date' =>$input['present_date'],
                    'classes_id' => $pi['class_id']
                ]);

                $attendance->present_students = (int)$pi['present_student'];
                $attendance->present_by = $this->user->id;
                // $id = $attendance->save()->id;
                $class->attendances()->save($attendance);
            }

            return response()->json(['success'=>1,'message'=>'Attendance successfully added']);
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