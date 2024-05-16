<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Rate;
use App\Models\Customer;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $area = Rate::where('id', $transaction->area)->first();

        return view('dashboard.transaction.track.show', [
            'title' => 'Detail Track',
            'data' => $transaction,
            'area' => $area->name,
        ]);
    }

    public function edit(transaction $transaction)
    {
        return view('dashboard.transaction.track.edit', [
            'title' => 'Edit Data Transaction',
            'data' => $transaction,
        ]);
    }

    public function update(Request $request, transaction $transaction)
    {
        $rules = [
            'letter_number' => 'required',
            'recipient' => 'required',
            'address' => 'required',
            'weight' => 'required',
            'cost' => 'required',
            'driver_fee' => 'required',
            'mark_fee' => 'required',
            'inline_fee' => 'required',
            'transport' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $transaction->update($validatedData);

        return redirect(
            'dashboard/transaction/track/' . $transaction->slug
        )->with('Success', 'data Has Been Updated');
    }
}
