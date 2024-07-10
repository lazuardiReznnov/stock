<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        return view('blog.index', [
            'title' => 'Blog',
            'datas' => Blog::with(['categoryblog', 'user'])
                ->latest()
                ->get(),
        ]);
    }
}
