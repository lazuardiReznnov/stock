<?php

namespace App\Http\Controllers\Dashboard\Maintenance;

use App\Models\Unit;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MaintenancePart;
use App\Models\Sparepart;
use Illuminate\Support\Str;
use Illuminate\support\Facades\Storage;

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
        $slug = $date . '-' . $unit_name . '-' . $rand;

        $validatedData['name'] = $name;
        $validatedData['slug'] = $slug;

        Maintenance::create($validatedData);

        return redirect('/dashboard/maintenance')->with(
            'success',
            'Data Has Been Added.!!'
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
        return view('dashboard.maintenance.edit', [
            'title' => 'Maintenance Edit',
            'data' => $maintenance,
            'units' => Unit::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validatedData = $request->validate([
            'unit_id' => 'required',
            'tgl' => 'required',
            'estimate' => 'required',
            'mechanic' => 'required',
            'description' => 'required',
            'instruction' => 'required',
        ]);

        $maintenance->update($validatedData);

        return redirect('/dashboard/maintenance')->with(
            'success',
            'Data Has Been Added.!!'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->destroy($maintenance->id);
        if ($maintenance->image) {
            foreach ($maintenance->image as $image) {
                storage::delete($image->pic);
                $image->delete();
            }
        }

        return redirect('/dashboard/maintenance')->with(
            'success',
            'Data Has Been Deleted'
        );
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

    public function createpart(Maintenance $maintenance)
    {
        return view('dashboard.maintenance.createpart', [
            'title' => 'Replacing Sparepart',
            'data' => $maintenance,
            'spareparts' => Sparepart::all(),
        ]);
    }

    public function storepart(Request $request, Maintenance $maintenance)
    {
        $validatedData = $request->validate([
            'sparepart_id' => 'required',
            'qty' => 'required',
        ]);

        $maintenance->maintenancePart()->create($validatedData);

        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been Added..!!'
        );
    }

    public function destroypart(MaintenancePart $maintenancePart)
    {
        $maintenancePart->destroy($maintenancePart->id);

        return redirect(
            'dashboard/maintenance/' . $maintenancePart->maintenance->slug
        )->with('success', 'Data Has Been Added..!!');
    }
}
