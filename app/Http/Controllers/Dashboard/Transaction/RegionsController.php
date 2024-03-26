<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function index()
    {
        return view('dashboard.transaction.rates.region.index', [
            'title' => 'Regions',
        ]);
    }
}
