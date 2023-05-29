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

        $report1 = InvoiceStock::latest();
        $report2 = InvoiceStock::latest();

        if ($request->search) {
            $pisah = explode('-', $request->search);

            $report1->when($request->search, function ($query) use ($pisah) {
                return $query
                    ->whereMonth('tgl', '=', $pisah[1])
                    ->whereYear('tgl', '=', $pisah[0]);
            });
            $report2->when($request->search, function ($query) use ($pisah) {
                return $query
                    ->whereMonth('tgl', '=', $pisah[1])
                    ->whereYear('tgl', '=', $pisah[0]);
            });
        }
        $date = $request->search ? $request->search : date('M Y');
        return view('dashboard.stock.report', [
            'title' => 'Payment Report ' . $date,

            'cashes' => $report1
                ->with('supplier', 'stock')
                ->where('method', '=', 'Cash')
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
            'debts' => $report2
                ->with('supplier', 'stock')
                ->where('method', '=', 'debt')
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
