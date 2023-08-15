<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\support\Facades\Storage;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transaction.customer.index', [
            'title' => 'Customer Data',
        ]);
    }

    public function show(Customer $customer)
    {
        //
    }
}
