<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Http\Controllers\Controller;
use App\Models\CategoryUnit;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryUnitController extends Controller
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
        $categoryUnit = CategoryUnit::query();

        $categoryUnit->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.unit.category-unit.index', [
            'title' => 'category Unit Model',
            'datas' => $categoryUnit
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
        return view('dashboard.unit.category-unit.create', [
            'title' => 'Input New Category Model',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:category_units',
            'slug' => 'required|unique:category_units',
            'description' => 'required',
        ]);

        $brand = CategoryUnit::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('categoryunit-pic');
            $brand->image()->create($data);
        }

        return redirect('dashboard/unit/categoryUnit')->with(
            'Success',
            'data Has Been added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryUnit $categoryUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryUnit $categoryUnit)
    {
        return view('dashboard.unit.category-unit.edit', [
            'title' => 'Category Unit',
            'data' => $categoryUnit->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryUnit $categoryUnit)
    {
        $rules = [
            'description' => 'required',
        ];

        if ($request->name != $categoryUnit->name) {
            $rules['name'] = 'required|unique:category_units';
        }
        if ($request->slug != $categoryUnit->slug) {
            $rules['slug'] = 'required|unique:category_units';
        }

        $validatedData = $request->validate($rules);

        $categoryUnit->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $categoryUnit->image()->delete();
            }
            $categoryUnit->image()->create([
                'pic' => $request->file('pic')->store('categoryUnit-pic'),
            ]);
        }
        return redirect('dashboard/unit/categoryUnit')->with(
            'Success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryUnit $categoryUnit)
    {
        $categoryUnit->destroy($categoryUnit->id);
        if ($categoryUnit->image) {
            storage::delete($categoryUnit->image->pic);
            $categoryUnit->image->delete();
        }

        return redirect('/dashboard/unit/categoryUnit')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            CategoryUnit::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }
}
