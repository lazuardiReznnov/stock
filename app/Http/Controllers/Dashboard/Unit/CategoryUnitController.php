<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Http\Controllers\Controller;
use App\Models\CategoryUnit;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.unit.category-unit.index', [
            'title' => 'category Unit Model',
        ]);
    }
}
