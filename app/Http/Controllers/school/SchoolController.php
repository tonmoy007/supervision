<?php

namespace App\Http\Controllers\school;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    public function all(Request $request) {
        if($request->isMethod('get')) {
            $schools = School::all();
            return response()->json(['success' =>1, 'message'=>'all school list', 'schools'=>$schools]);
        }
    }
    public function add(Request $request) {
        if($request->isMethod('post')) {
            $school = new School();
            $school->name = $request->get('name');
            $school->email = $request->get('email');
            $school->password = bcrypt($request->get('password'));
            $school->save();
            return response()->json(['id' => $school->id,'success'=>1,'message'=>'school successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update($id, Request $request)
    {
        if ($request->method('put')) {
            try {
                $school = School::where('id', $id)->first();
                $school->name = $request->get('name');
                $school->email = $request->get('email');
                if($request->get('password')) {
                    $school->password = bcrypt($request->get('password'));
                }
                $school->email = $request->get('category');
                $school->email = $request->get('teacher');
                $school->email = $request->get('female_teacher');
                $school->email = $request->get('upozilla');
                $school->email = $request->get('zilla');
                $school->email = $request->get('management');
                $school->email = $request->get('type');
                $school->email = $request->get('mpo_code');
                $school->email = $request->get('mpo_date');
                $school->email = $request->get('eiin_number');
                $school->update();
                return response()->json(['id' => $school->id,'success'=>1,'message'=>'school successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function delete($id)
    {
        $school = School::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $school->delete();
        return response()->json(['success'=>1,'message'=>'school successfully deleted']);

    }
}
