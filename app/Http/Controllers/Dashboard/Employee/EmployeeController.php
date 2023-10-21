<?php

namespace App\Http\Controllers\Dashboard\Employee;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('dashboard.employee.index', [
            'title' => 'Employee Management',
        ]);
    }

    public function data()
    {
        return view('dashboard.employee.data', [
            'title' => 'employee Data',
            'datas' => Division::all(),
        ]);
    }
}
