<?php

namespace App\Http\Controllers\Employee;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('dashboard.employee.index', [
            'title' => 'Employee Data',
            'datas' => Division::all(),
        ]);
    }
}
