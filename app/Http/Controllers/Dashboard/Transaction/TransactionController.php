<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\transaction;

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

    public function show(transaction $transaction)
    {
        return view('dashboard.transaction.track.show', [
            'title' => 'Detail Track',
            'data' => $transaction,
        ]);
    }
}
