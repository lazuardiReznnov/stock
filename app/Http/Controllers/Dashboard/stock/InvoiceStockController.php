<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Models\Type;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\InvoiceStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class InvoiceStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard.stock.invoice.index', [
            'title' => 'Invoice Stock Data',
            'datas' => InvoiceStock::latest()
                ->with('Supplier', 'stock')
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
            'name' => 'required|unique:invoice_stocks',
            'slug' => 'required|unique:invoice_stocks',
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
        return view('dashboard.stock.invoice.show', [
            'title' => 'Detail Invoice - ' . $invoiceStock->name,
            'data' => $invoiceStock,
            'stocks' => Stock::where('invoice_stock_id', $invoiceStock->id)
                ->with('sparepart')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceStock $invoiceStock)
    {
        return view('dashboard.stock.invoice.edit', [
            'title' => 'Edit Invoice',
            'data' => $invoiceStock->load('image'),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceStock $invoiceStock)
    {
        $rules = [
            'supplier_id' => 'required',
            'tgl' => 'required',
        ];

        if ($request->name != $invoiceStock->name) {
            $rules['name'] = 'required|unique:invoice_stocks';
        }
        if ($request->slug != $invoiceStock->slug) {
            $rules['slug'] = 'required|unique:invoice_stocks';
        }

        $validatedData = $request->validate($rules);
        InvoiceStock::where('id', $invoiceStock->id)->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $invoiceStock->image()->delete();
            }
            $invoiceStock->image()->create([
                'pic' => $request->file('pic')->store('invoiceStock-pic'),
            ]);
        }

        return redirect('/dashboard/stock/invoiceStock')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceStock $invoiceStock)
    {
        $invoiceStock->destroy($invoiceStock->id);
        if ($invoiceStock->image) {
            storage::delete($invoiceStock->image->pic);
            $invoiceStock->image->delete();
        }

        return redirect('/dashboard/stock/invoiceStock')->with(
            'success',
            'Data Has Been Deleted'
        );
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

    public function stockin(InvoiceStock $invoiceStock)
    {
        return view('dashboard.stock.invoice.stock-in', [
            'title' => 'Stock In',
            'spareparts' => Sparepart::with('category', 'type')->get(),
            'invoice' => $invoiceStock,
        ]);
    }

    public function slug(Request $request)
    {
        $slug = SlugService::createSlug(Stock::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function storestock(Request $request)
    {
        $validatedData = $request->validate([
            'sparepart_id' => 'required',
            'invoice_stock_id' => 'required',
            'name' => 'required|unique:stocks',
            'slug' => 'required|unique:stocks',
            'brand' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        Stock::create($validatedData);

        return redirect(
            '/dashboard/stock/invoiceStock/' . $request->invoice_slug
        )->with('success', 'Data Has Been Added.!');
    }

    public function destroystock(Stock $stock)
    {
        $stock->destroy($stock->id);

        return redirect(
            '/dashboard/stock/invoiceStock/' . $stock->invoiceStock->slug
        )->with('success', 'Data Hasbeen Deleted');
    }

    public function editstock(Stock $stock)
    {
        return view('dashboard.stock.invoice.edit-stock-in', [
            'title' => 'edit Stock item',
            'data' => $stock,
            'spareparts' => Sparepart::with('category', 'type')->get(),
            'invoice' => $stock->invoiceStock,
        ]);
    }

    public function updatestock(Request $request, Stock $stock)
    {
        $rules = [
            'sparepart_id' => 'required',
            'invoice_stock_id' => 'required',
            'brand' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ];

        if ($request->name != $stock->name) {
            $rules['name'] = 'required|unique:stocks';
        }
        if ($request->slug != $stock->slug) {
            $rules['slug'] = 'required|unique:stocks';
        }

        $validatedData = $request->validate($rules);

        Stock::where('id', $stock->id)->update($validatedData);

        return redirect(
            '/dashboard/stock/invoiceStock/' . $request->invoice_slug
        )->with('success', 'Data Has Been Updated');
    }
}
