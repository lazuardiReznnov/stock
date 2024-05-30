<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Models\Customer;
use App\Models\Postmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

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
        return view('dashboard.transaction.customer.show', [
            'title' => 'Detail Customer',
            'data' => $customer,
        ]);
    }

    public function postmail(PostMail $postmail)
    {
        return view('dashboard.transaction.customer.postmail', [
            'data' => $postmail->load('customer'),
        ]);
    }
}
