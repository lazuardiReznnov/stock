<?php

namespace App\Http\Controllers\Dashboard\Maintenance;

use App\Models\Stock;

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
    public function index()
    {
        return view('dashboard.maintenance.index', [
            'title' => 'maintenance Management',
        ]);
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
            'qty' => 'required',
            'description' => 'required',
        ]);

        $stock = Stock::find($request->id);

        $validatedData['sparepart_id'] = $stock->sparepart_id;
        $validatedData['price'] = $stock->price;

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
            'qty' => 'required',
            'description' => 'required',
        ]);

        $stock = Stock::find($request->id);

        $validatedData['sparepart_id'] = $stock->sparepart_id;
        $validatedData['price'] = $stock->price;
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
