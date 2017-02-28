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
        $school = School::where('user_id', $this->user->id)->first();
        $totalStudents = School::find($school->id)->classes->sum('total_students');
        $today = Carbon::now()->toDateString();
        $school = School::where('user_id', $this->user->id)->first();
        $classes = Classes::where('school_id', $school->id)->get();


        $classIDs = array();
        foreach ($classes as $class) {
            //die(var_dump($class));
            array_push($classIDs, $class->id);
        }
        $attendances = Attendance::whereHas("classes", function ($query) use($classIDs){
            $query->whereIn('classes.id', $classIDs);
        })->orderBy('attendances.present_date', 'desc')->groupBy('attendances.id', 'attendances.present_date', 'attendances.classes_id','attendances.present_students','attendances.present_by', 'attendances.created_at', 'attendances.updated_at' )->get();
        $attendances = $attendances->toArray();
        $resp = array();
        $dates = array_column($attendances, 'present_date');
        $dates = array_unique($dates);
        foreach ($dates as $date) {
            $classInfo = array();
            $present=0;
            $total=0;
            $absent=0;
            foreach ($attendances as $key =>$attendance) {
                if($attendance['present_date'] == $date){
                    array_push($classInfo, $attendance);
                    $present += $attendance['present_students'];
                    $total += $attendance['total_students'];
                    $absent += $attendance['absent_students'];
                    unset($attendances[$key]);
                }
            }
            array_push($resp, ['present_date'=>$date, 'present_students'=> $present, 'absent_students'=> $absent,
                'total_students'=> $total,'classes' =>$classInfo]);
        }
        return response()->json(['success'=>1,'message'=>'Attendance successfully found',
                             'attendance' => $resp    ]);
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

                $attendance->present_students = (int)$pi['present_students'];
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