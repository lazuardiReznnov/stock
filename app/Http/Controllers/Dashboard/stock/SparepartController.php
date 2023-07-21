<?php

namespace App\Http\Controllers\Dashboard\stock;

use App\Models\Type;
use App\Models\Category;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Imports\SparepartImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SparepartController extends Controller
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
        $sparepart = Sparepart::query();

        $sparepart->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.stock.sparepart.index', [
            'title' => 'Sparepart Data',
            'datas' => $sparepart
                ->with('type', 'category', 'image')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.stock.sparepart.create', [
            'title' => 'Create data',
            'types' => Type::all(),
            'categories' => Category::All(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'code' => 'required|unique:spareparts',
            'description' => 'required',
        ]);

        $sparepart = Sparepart::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('sparepart-pic');
            $sparepart->image()->create($data);
        }

        return redirect('/dashboard/stock/sparepart')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Sparepart $sparepart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sparepart $sparepart)
    {
        return view('dashboard.stock.sparepart.edit', [
            'title' => 'Edit data',
            'types' => Type::all(),
            'categories' => Category::All(),
            'data' => $sparepart->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $rules = [
            'category_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ];
        if ($request->code != $sparepart->name) {
            $rules['code'] = 'required|unique:spareparts';
        }

        $validatedData = $request->validate($rules);
        Sparepart::where('id', $sparepart->id)->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $sparepart->image()->delete();
            }
            $sparepart->image()->create([
                'pic' => $request->file('pic')->store('sparepart-pic'),
            ]);
        }

        return redirect('/dashboard/stock/sparepart')->with(
            'success',
            'Data has Been Saved'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->destroy($sparepart->id);
        if ($sparepart->image) {
            storage::delete($sparepart->image->pic);
            $sparepart->image->delete();
        }

        return redirect('/dashboard/stock/sparepart')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(
            Sparepart::class,
            'slug',
            $request->name
        );
        return response()->json(['slug' => $slug]);
    }

    public function createexcl()
    {
        return view('dashboard.stock.sparepart.create-excel', [
            'title' => 'File Import Via Excel',
        ]);
    }

    public function storeexcl(Request $request)
    {
        $validatedData = $request->validate([
            'excl' => 'required:mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($request->file('excl')) {
            Excel::import(new SparepartImport(), $validatedData['excl']);
            return redirect('/dashboard/stock/sparepart')->with(
                'success',
                'New Data Has Been Aded.!'
            );
        }
    }
}
