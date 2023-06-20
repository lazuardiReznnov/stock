<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

use function PHPSTORM_META\map;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $unit = Unit::query();

        $unit->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.unit.index', [
            'title' => 'Unit Management',
            'datas' => $unit
                ->with('type', 'group', 'image', 'spesification')
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
        return view('dashboard.unit.create', [
            'title' => 'Create Unit',
            'brands' => Brand::all(),
            'groups' => Group::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_id' => 'required',
            'group_id' => 'required',
            'name' => 'required|unique:units',
            'slug' => 'required|unique:units',
            'description' => 'required',
        ]);

        $unit = Unit::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('unit-pic');
            $unit->image()->create($data);
        }
        $unit->spesification()->create();

        return redirect('dashboard/unit')->with(
            'Success',
            'data Has Been added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('dashboard.unit.show', [
            'title' => 'Detail ' . $unit->name,
            'data' => $unit->load(
                'type',
                'group',
                'image',
                'spesification',
                'vpic',
                'vrc'
            ),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('dashboard.unit.edit', [
            'title' => 'Edit' . $unit->name,
            'data' => $unit,
            'brands' => Brand::all(),
            'groups' => Group::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $rules = [
            'type_id' => 'required',
            'group_id' => 'required',
            'description' => 'required',
        ];

        if ($request->name != $unit->name) {
            $rules['name'] = 'required|unique:units';
        }
        if ($request->slug != $unit->slug) {
            $rules['slug'] = 'required|unique:units';
        }

        $validatedData = $request->validate($rules);

        $unit->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $unit->image()->delete();
            }
            $unit->image()->create([
                'pic' => $request->file('pic')->store('unit-pic'),
            ]);
        }
        return redirect('dashboard/unit')->with(
            'Success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->destroy($unit->id);
        if ($unit->image) {
            storage::delete($unit->image->pic);
            $unit->image->delete();
        }

        return redirect('/dashboard/unit')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Unit::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function getType(Request $request)
    {
        $type = Type::where('brand_id', '=', $request->brand)->get();
        return response()->json($type);
    }

    public function editspesification(Unit $unit)
    {
        return view('dashboard.unit.edit-spesification', [
            'title' => 'Edit Spesification',
            'data' => $unit->load('spesification'),
        ]);
    }

    public function updatespesification(Request $request, Unit $unit)
    {
        $validatedData = $request->validate([
            'vin' => 'required',
            'en' => 'required',
            'year' => 'required',
            'color' => 'required',
            'model' => 'required',
            'fuel' => 'required',
            'cylinder' => 'required',
        ]);

        $unit->spesification()->update($validatedData);

        return redirect('dashboard/unit/' . $unit->slug)->with(
            'success',
            'Data Has Been Updated'
        );
    }
}
