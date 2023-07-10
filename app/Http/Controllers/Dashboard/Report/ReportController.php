<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Models\Vrc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.report.index', [
            'title' => 'Report Data',
        ]);
    }

    public function vrc(Request $request)
    {
        $datey = date('Y');
        $datem = date('m');

        $report = Vrc::latest();

        if ($request->search) {
            $pisah = explode('-', $request->search);

            $report->when($request->search, function ($query) use ($pisah) {
                return $query
                    ->whereMonth('tgl', '=', $pisah[1])
                    ->whereYear('tgl', '=', $pisah[0]);
            });
        }
        return view('dashboard.report.vrc', [
            'title' => 'Vehicle Registration Certificate Data',
            'datas' => $report
                ->with('unit')
                // ->whereMonth('tax', '=', $datem)
                // ->whereYear('tax', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
