<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('dashboard.transaction.rates.index', [
            'title' => 'Rates',
            'datas' => Customer::latest()->paginate(10),
        ]);
    }

    public function data(Customer $customer)
    {
        return view('dashboard.transaction.rates.data', [
            'title' => $customer->name,
            'data' => $customer->id,
        ]);
    }
}
