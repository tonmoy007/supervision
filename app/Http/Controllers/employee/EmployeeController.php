<?php

namespace App\Http\Controllers\employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function all(Request $request) {
        if($request->isMethod('get')) {
            $employees = Employee::all()->groupBy(function($employee){ return $employee->designation; });

            return response()->json(['success' =>1, 'message'=>'all employee list', 'employees'=>$employees]);
        }
    }
    public function add(Request $request) {
        if($request->isMethod('post')) {
            $employee = new Employee();
            $employee->name = $request->get('name');
            $employee->designation = $request->get('designation');
            $employee->rank = $request->get('rank');
            $employee->image = "lol";
            $employee->save();
            if($request->file("featured_image")) {
                $dir = "employee/".$employee->id;
                $path = $request->file('featured_image')->store($dir);
                $employee->image = Storage::disk('local')->url($path);
                $employee->update();
            }
            return response()->json(['id' => $employee->id,'success'=>1,'message'=>'Employee successfully added']);
        }

        return response()->json(['type' => 'method is not allowed','success'=>0,'message'=>'Not a post method']);


    }

    public function update($id, Request $request)
    {
        if ($request->method('put')) {
            try {
                $employee = Employee::where('id', $id)->first();
                $employee->name = $request->get('name');
                $employee->designation = $request->get('designation');
                $employee->rank = $request->get('rank');
                if($request->file("featured_image")) {
                    $dir = "employee/".$employee->id;
                    $path = $request->file('featured_image')->store($dir);
                    $employee->image = Storage::disk('local')->url($path);
                }
                $employee->update();
                return response()->json(['id' => $employee->id,'success'=>1,'message'=>'Employee successfully updated']);
            } catch (Exception $e) {
                return response()->json(['success'=>0,'message'=>'update error']);

            }
        }
    }

    public function delete($id)
    {
        $employee = Employee::where("id", $id)->first();
        //FileUtils::deleteDir(public_path() . '/image/products/' . $id);
        //ProductImage::where("product_id", $id)->delete();
        $employee->delete();
        return response()->json(['success'=>1,'message'=>'Employee successfully deleted']);

    }
}
