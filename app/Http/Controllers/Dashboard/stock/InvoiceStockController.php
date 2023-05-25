<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Models\InvoiceStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Cviebrock\EloquentSluggable\Services\SlugService;

class InvoiceStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.stock.invoice.index', [
            'title' => 'Invoice Stock Data',
            'datas' => InvoiceStock::latest()
                ->with('Supplier')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.stock.invoice.create', [
            'title' => 'Create Invoice Stock',
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'name' => 'required|unique:suppliers',
            'slug' => 'required|unique:suppliers',
            'tgl' => 'required',
        ]);

        $invoice = InvoiceStock::create($validatedData);

        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('invoice-pic');
            $invoice->image()->create($data);
        }

        return redirect('/dashboard/stock/invoiceStock')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceStock $invoiceStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceStock $invoiceStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceStock $invoiceStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceStock $invoiceStock)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            InvoiceStock::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }
}
