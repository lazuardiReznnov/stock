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
    public function index(Request $request)
    {
        $customer = Customer::query();

        $customer->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.transaction.customer.index', [
            'title' => 'Customer Data',
            'datas' => $customer
                ->latest()
                ->with('image')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.transaction.customer.create', [
            'title' => 'Add Customer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:customers',
            'slug' => 'required|unique:customers',
            'phone' => 'required',
            'address' => 'required',
            'industry' => 'required',
        ]);

        $customer = Customer::create($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('customer-pic');
            $customer->image()->create($data);
        }

        return redirect('/dashboard/transaction/customer')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.transaction.customer.edit', [
            'title' => 'Edit Customer',
            'data' => $customer->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'phone' => 'required',
            'address' => 'required',
            'industry' => 'required',
        ];

        if ($request->name != $customer->name) {
            $rules['name'] = 'required|unique:customers';
        }
        if ($request->slug != $customer->slug) {
            $rules['slug'] = 'required|unique:customers';
        }

        $validatedData = $request->validate($rules);

        $customer->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $customer->image()->delete();
            }
            $customer->image()->create([
                'pic' => $request->file('pic')->store('customer-pic'),
            ]);
        }

        return redirect('/dashboard/transaction/customer')->with(
            'success',
            'Data has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->destroy($customer->id);
        if ($customer->image) {
            storage::delete($customer->image->pic);
            $customer->image->delete();
        }

        return redirect('/dashboard/transaction/customer')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Customer::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }
}
