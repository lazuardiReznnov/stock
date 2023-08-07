<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Models\Vrc;
use App\Models\Unit;
use App\Models\Vpic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Storage;

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
                    ->whereMonth('tax', '=', $pisah[1])
                    ->whereYear('tax', '=', $pisah[0]);
            });
        } else {
            $report
                ->whereMonth('tax', '=', $datem)
                ->whereYear('tax', '=', $datey);
        }
        return view('dashboard.report.vrc', [
            'title' => 'Vehicle Registration Certificate Data',
            'datas' => $report
                ->with('unit')

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

    public function editvrctax(Unit $unit)
    {
        return view('dashboard.report.editvrc-tax', [
            'title' => 'Update VRC Tax Date',
            'data' => $unit->load('vrc'),
        ]);
    }

    public function updatevrctax(Unit $unit, Request $request)
    {
        $validatedData = $request->validate([
            'tax' => 'required',
        ]);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $unit->vrc->image()->delete();
            }
            $unit->vrc->image()->create([
                'pic' => $request->file('pic')->store('unit-vrctax-pic'),
            ]);
        }

        $unit->vrc()->update($validatedData);

        return redirect('/dashboard/report/vrc')->with(
            'success',
            'data Has Been Updated'
        );
    }

    public function vpic(Request $request)
    {
        $datey = date('Y');
        $datem = date('m');

        $report = Vpic::latest();

        if ($request->search) {
            $pisah = explode('-', $request->search);

            $report->when($request->search, function ($query) use ($pisah) {
                return $query
                    ->whereMonth('expire', '=', $pisah[1])
                    ->whereYear('expire', '=', $pisah[0]);
            });
        }
        return view('dashboard.report.vpic', [
            'title' => 'Vehicle Inspection Data',
            'datas' => $report
                ->with('unit')
                ->whereMonth('expire', '=', $datem)
                ->whereYear('expire', '=', $datey)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function editvpicexpire(Unit $unit)
    {
        return view('dashboard.report.editvpic-expire', [
            'title' => 'Update VPIC Expire Date',

            'data' => $unit->load('vrc'),
        ]);
    }

    public function updatevpicexpire(Unit $unit, Request $request)
    {
        $validatedData = $request->validate([
            'expire' => 'required',
        ]);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $unit->vpic->image()->delete();
            }
            $unit->vrc->image()->create([
                'pic' => $request->file('pic')->store('unit-vrc-pic'),
            ]);
        }

        $unit->vpic()->update($validatedData);

        return redirect('/dashboard/report/vpic')->with(
            'success',
            'data Has Been Updated'
        );
    }
}
