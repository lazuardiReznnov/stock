<?php

namespace App\Http\Controllers\Dashboard\Employee;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
        return view('dashboard.employee.division.index', [
            'title' => 'Employee Data',
        ]);
    }
}
