<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Models\Tag;
use App\Models\Type;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Sparepart;
use App\Models\InvoiceStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        ]);
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
                ->get(),
        ]);
    }

    public function stockin(InvoiceStock $invoiceStock)
    {
        return view('dashboard.stock.invoice.stock-in', [
            'title' => 'Stock In',
            'spareparts' => Sparepart::with('category')->get(),
            'types' => Type::with('brand', 'categoryUnit')->get(),
            'invoice' => $invoiceStock,
            'tags' => Tag::all(),
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
            'name' => 'required',
            'slug' => 'required|unique:stocks',
            'brand' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $stock = Stock::create($validatedData);

        if ($request->tag_id) {
            $stock->tags()->sync($request->tag_id);
        }

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
            'tags' => Tag::all(),
        ]);
    }

    public function updatestock(Request $request, Stock $stock)
    {
        $rules = [
            'name' => 'required',
            'sparepart_id' => 'required',
            'invoice_stock_id' => 'required',
            'brand' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ];

        // if ($request->name != $stock->name) {
        //     $rules['name'] = 'required|unique:stocks';
        // }
        if ($request->slug != $stock->slug) {
            $rules['slug'] = 'required|unique:stocks';
        }

        $validatedData = $request->validate($rules);

        Stock::where('id', $stock->id)->update($validatedData);
        if ($request->tag_id) {
            $stock->tags()->sync($request->tag_id);
        }

        return redirect(
            '/dashboard/stock/invoiceStock/' . $request->invoice_slug
        )->with('success', 'Data Has Been Updated');
    }
}
