<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        return view('dashboard.transaction.index', [
            'title' => 'Transaction',
            'customer' => Customer::All(),
        ]);
    }

    public function track()
    {
        return view('dashboard.transaction.track.index', [
            'title' => 'Track',
        ]);
    }
}
