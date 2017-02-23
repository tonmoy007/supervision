<?php

namespace App\Http\Controllers\school;

use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
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
        //    $this->middleware('admin', ['only' => ['store']]);
        }
    }
    public function index() {
            
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->only(['present_students', 'present_date']);
            if (!isset($input['present_date'])) {
                $input['present_date'] = Carbon::now();
            }
            $class = Classes::find($request->get('class_id'));
            $input['present_by'] = $this->user->id;
            $class->attendances()->updateOrCreate($input);
        }
    }
}
