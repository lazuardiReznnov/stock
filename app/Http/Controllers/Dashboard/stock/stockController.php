<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InvoiceStock;
use Illuminate\Http\Request;

class stockController extends Controller
{
    public function index()
    {
        return view('dashboard.stock.index', [
            'title' => 'Stock Table',
            'datas' => Category::with('sparepart')->get(),
        ]);
    }

    public function report(Request $request)
    {
        $datey = date('Y');
        $datem = date('m');

        $report = InvoiceStock::query();

        if ($request->search) {
            $pisah = explode('-', $request->search);

            $report->when($request->search, function ($query) use ($pisah) {
                return $query
                    ->whereMonth('tgl', '=', $pisah[1])
                    ->whereYear('tgl', '=', $pisah[0]);
            });
        }
        $date = $request->search ? $request->search : date('M Y');
        return view('dashboard.stock.report', [
            'title' => 'Payment Report ' . $date,

            'cashes' => $report
                ->with('supplier', 'stock')

                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
