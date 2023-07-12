<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Models\Vrc;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
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
                ->whereMonth('tax', '=', $datem)
                ->whereYear('tax', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function editvrcexpire(Unit $unit)
    {
        return view('dashboard.report.editvrc-expire', [
            'title' => 'Update VRC Expire Date',
            'data' => $unit->load('vrc'),
        ]);
    }

    public function updatevrcexpire(Unit $unit, Request $request)
    {
        $validatedData = $request->validate([
            'expire' => 'required',
        ]);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $unit->vrc->image()->delete();
            }
            $unit->vrc->image()->create([
                'pic' => $request->file('pic')->store('unit-vrc-pic'),
            ]);
        }

        $unit->vrc()->update($validatedData);

        return redirect('/dashboard/report/vrc')->with(
            'success',
            'data Has Been Updated'
        );
    }
}
