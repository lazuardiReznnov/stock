<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index()
    {
        return view('dashboard.transaction.rates.index', [
            'title' => 'Rates',
            'datas' => Customer::latest()->paginate(10),
        ]);
    }
}
