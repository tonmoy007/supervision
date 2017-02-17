<?php

namespace App\Http\Controllers\link;

use App\Models\LinkCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = LinkCategory::all();
            return response()->json(['success' => 1, 'message' => 'all employee list', 'categories' => $categories]);
        }
    }
}
