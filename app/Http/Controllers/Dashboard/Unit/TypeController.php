<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Models\Type;
use App\Models\Brand;
use App\Models\CategoryUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TypeController extends Controller
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
        $type = Type::query();

        $type->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.unit.type.index', [
            'title' => 'Type Model',
            'datas' => $type
                ->with('brand', 'categoryUnit', 'image')

                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.unit.type.create', [
            'title' => 'Add New Type',
            'brands' => Brand::all(),
            'categories' => CategoryUnit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_id' => 'required',
            'category_unit_id' => 'required',
            'name' => 'required|unique:types',
            'slug' => 'required|unique:types',
            'description' => 'required',
        ]);

        $type = Type::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('categoryunit-pic');
            $type->image()->create($data);
        }

        return redirect('dashboard/unit/type')->with(
            'Success',
            'data Has Been added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('dashboard.unit.type.edit', [
            'title' => 'Edit Type',
            'data' => $type->load('image'),
            'brands' => Brand::all(),
            'categories' => CategoryUnit::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $rules = [
            'brand_id' => 'required',
            'category_unit_id' => 'required',
            'description' => 'required',
        ];

        if ($request->name != $type->name) {
            $rules['name'] = 'required|unique:types';
        }
        if ($request->slug != $type->slug) {
            $rules['slug'] = 'required|unique:types';
        }

        $validatedData = $request->validate($rules);

        $type->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $type->image()->delete();
            }
            $type->image()->create([
                'pic' => $request->file('pic')->store('type-pic'),
            ]);
        }
        return redirect('dashboard/unit/type')->with(
            'Success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->destroy($type->id);
        if ($type->image) {
            storage::delete($type->image->pic);
            $type->image->delete();
        }

        return redirect('/dashboard/unit/type')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Type::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
