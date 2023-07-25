<?php

namespace App\Http\Controllers\Dashboard\Maintenance;

use App\Models\Unit;
use App\Models\Stock;
use App\Models\statelog;
use App\Models\Sparepart;
use App\Models\Maintenance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MaintenancePart;
use App\Http\Controllers\Controller;
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
            'data' => $maintenance->load(
                'unit',
                'maintenancePart',
                'statelog',
                'image'
            ),
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
            'spareparts' => Stock::all(),
        ]);
    }

    public function storepart(Request $request, Maintenance $maintenance)
    {
        $validatedData = $request->validate([
            'sparepart_id' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'price' => 'required',
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

    public function editpart(MaintenancePart $maintenancePart)
    {
        return view('dashboard.maintenance.editpart', [
            'title' => 'Edit Replacing Part',
            'data' => $maintenancePart,
            'spareparts' => Stock::all(),
        ]);
    }

    public function updatepart(
        Request $request,
        MaintenancePart $maintenancePart
    ) {
        $validatedData = $request->validate([
            'sparepart_id' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $maintenancePart->update($validatedData);

        return redirect(
            'dashboard/maintenance/' . $maintenancePart->maintenance->slug
        )->with('success', 'Data Has Been Added..!!');
    }

    public function createupload(Maintenance $maintenance)
    {
        return view('dashboard.maintenance.createupload', [
            'title' => 'Upload Image',
            'data' => $maintenance,
        ]);
    }

    public function storeupload(Request $request, Maintenance $maintenance)
    {
        $this->validate($request, [
            'pic[]' => 'image|file|max:2048',
        ]);

        if ($request->file('pic')) {
            foreach ($request->file('pic') as $pic) {
                $maintenance
                    ->image()
                    ->create(['pic' => $pic->store('maintenance-pic')]);
            }
        }
        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been Added..!!'
        );
    }

    public function editlog(Maintenance $maintenance, $id)
    {
        $statelog = $maintenance->statelog()->find($id);

        return view('dashboard.maintenance.editlog', [
            'title' => 'Edit Log',
            'data' => $statelog,
        ]);
    }

    public function updatelog(Maintenance $maintenance, Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $maintenance
            ->statelog()
            ->where('id', $id)
            ->update($validatedData);

        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been added.!!'
        );
    }

    public function destroylog(Maintenance $maintenance, Request $request)
    {
        statelog::destroy($request->id);

        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been added.!!'
        );
    }

    public function destroyupload(Maintenance $maintenance, Request $request)
    {
        $data = $maintenance->image->find($request->id);
        storage::delete($data->pic);
        $data->delete();

        return redirect('dashboard/maintenance/' . $maintenance->slug)->with(
            'success',
            'Data Has Been Added..!!'
        );
    }

    public function print(Maintenance $maintenance)
    {
        return view('dashboard.maintenance.print-wo', [
            'title' => 'Work Order Letter',
            'data' => $maintenance->load('unit', 'maintenancePart'),
        ]);
    }
}
