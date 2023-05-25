<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class stockController extends Controller
{
    public function index()
    {
        return view('dashboard.stock.index', [
            'title' => 'Stock Table',
            'datas' => Category::with('sparepart')->get(),
        ]);
    }
}
