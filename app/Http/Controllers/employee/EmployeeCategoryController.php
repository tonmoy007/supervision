<?php

namespace App\Http\Controllers\employee;

use App\Models\EmployeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = EmployeeCategory::all();
            return response()->json(['success' => 1, 'message' => 'all employee list', 'categories' => $categories]);
        }
    }
}
