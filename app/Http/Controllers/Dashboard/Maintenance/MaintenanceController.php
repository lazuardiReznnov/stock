<?php

namespace App\Http\Controllers\Dashboard\Maintenance;

use App\Models\Unit;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class MaintenanceController extends Controller
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
        $maintenance = Maintenance::query();

        $maintenance->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.maintenance.index', [
            'title' => 'maintenance Management',
            'datas' => $maintenance
                ->with('unit')
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.maintenance.create', [
            'title' => 'Maintenance Create',
            'units' => Unit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_id' => 'required',
            'tgl' => 'required',
            'estimate' => 'required',
            'mechanic' => 'required',
            'description' => 'required',
            'instruction' => 'required',
        ]);

        $date = date('Ymd');
        $unit_name = $request->unit_id;
        $rand = rand(0, 100);

        $name = $date . $unit_name . $rand;
        $slug = $unit_name . '-' . $date . '-' . $rand;
        $validatedData['name'] = $name;
        $validatedData['slug'] = $slug;

        Maintenance::create($validatedData);

        return redirect('/dashboard/maintenance')->with(
            'success',
            'Data Has Been added.!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('dashboard.maintenance.show', [
            'title' => 'Maintenance data - ' . $maintenance->unit->name,
            'data' => $maintenance->load('unit', 'maintenancePart', 'statelog'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }

    public function createlog(Maintenance $maintenance)
    {
        return view('dashboard.maintenance.createlog', [
            'title' => 'Update Log',
            'data' => $maintenance,
        ]);
    }

    public function storelog(Request $request, Maintenance $maintenance)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $maintenance->statelog()->create($validatedData);
        $maintenance->update(['progress' => $request->progress]);

        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been added.!!'
        );
    }
}
