<?php

namespace App\Http\Controllers\posts;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = PostCategory::all();
            return response()->json(['success' => 1, 'message' => 'all employee list', 'categories' => $categories]);
        }
    }
}
