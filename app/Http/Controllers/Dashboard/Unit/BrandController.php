<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brand = Brand::query();

        $brand->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.unit.brand.index', [
            'title' => 'Brand Model',
            'datas' => $brand
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
        return view('dashboard.unit.brand.create', [
            'title' => 'Input New Brand Model',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
            'description' => 'required',
        ]);

        $brand = brand::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('brand-pic');
            $brand->image()->create($data);
        }

        return redirect('dashboard/unit/brand')->with(
            'Success',
            'data Has Been added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.unit.brand.edit', [
            'title' => 'Edit Brand Model',
            'data' => $brand->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [
            'description' => 'required',
        ];

        if ($request->name != $brand->name) {
            $rules['name'] = 'required|unique:brands';
        }
        if ($request->slug != $brand->slug) {
            $rules['slug'] = 'required|unique:brands';
        }

        $validatedData = $request->validate($rules);

        $brand->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $brand->image()->delete();
            }
            $brand->image()->create([
                'pic' => $request->file('pic')->store('brand-pic'),
            ]);
        }
        return redirect('dashboard/unit/brand')->with(
            'Success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->destroy($brand->id);
        if ($brand->image) {
            storage::delete($brand->image->pic);
            $brand->image->delete();
        }

        return redirect('/dashboard/unit/brand')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Brand::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
