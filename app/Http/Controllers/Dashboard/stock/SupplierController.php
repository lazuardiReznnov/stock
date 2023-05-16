<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $supp = Supplier::query();

        $supp->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.stock.supplier.index', [
            'title' => 'Supplier Data',
            'datas' => $supp
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
        return view('dashboard.stock.supplier.create', [
            'title' => 'Create Supplier',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:suppliers',
            'slug' => 'required|unique:suppliers',
            'phone' => 'required',
            'email' => 'required|unique:suppliers',
            'address' => 'required',
        ]);

        $supplier = Supplier::create($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('supplier-pic');
            $supplier->image()->create($data);
        }

        return redirect('/dashboard/stock/supplier')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('dashboard.stock.supplier.show', [
            'title' => 'Detail Data',
            'data' => $supplier->load('image'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.stock.supplier.edit', [
            'title' => 'Edit Supplier Data',
            'data' => $supplier->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $rules = [
            'phone' => 'required',
            'address' => 'required',
        ];

        if ($request->name != $supplier->name) {
            $rules['name'] = 'required|unique:suppliers';
        }
        if ($request->slug != $supplier->slug) {
            $rules['slug'] = 'required|unique:suppliers';
        }
        if ($request->email != $supplier->email) {
            $rules['email'] = 'required|unique:suppliers';
        }

        $validatedData = $request->validate($rules);

        Supplier::where('id', $supplier->id)->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $supplier->image()->delete();
            }
            $supplier->image()->create([
                'pic' => $request->file('pic')->store('supplier-pic'),
            ]);
        }

        return redirect('/dashboard/stock/supplier')->with(
            'success',
            'Data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->destroy($supplier->id);
        if ($supplier->image) {
            storage::delete($supplier->image->pic);
            $supplier->image->delete();
        }

        return redirect('/dashboard/stock/supplier')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Supplier::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }
}
