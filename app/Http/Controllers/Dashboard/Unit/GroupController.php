<?php

namespace App\Http\Controllers\Dashboard\Unit;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\support\Facades\Storage;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $group = Group::query();

        $group->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        });

        return view('dashboard.unit.group.index', [
            'title' => 'Unit Group',
            'datas' => $group
                ->with('image')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('dashboard.unit.group.create', [
            'title' => 'Add Group Unit',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:groups',
            'slug' => 'required|unique:groups',
            'description' => 'required',
        ]);

        $group = Group::create($validatedData);
        if ($request->file('pic')) {
            $data = $request->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $request->file('pic')->store('group-pic');
            $group->image()->create($data);
        }

        return redirect('dashboard/unit/group')->with(
            'Success',
            'data Has Been added'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('dashboard.unit.group.edit', [
            'title' => 'edit Group',
            'data' => $group->load('image'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $rules = [
            'description' => 'required',
        ];

        if ($request->name != $group->name) {
            $rules['name'] = 'required|unique:groups';
        }
        if ($request->slug != $group->slug) {
            $rules['slug'] = 'required|unique:groups';
        }

        $validatedData = $request->validate($rules);

        $group->update($validatedData);

        if ($request->file('pic')) {
            $request->validate(['pic' => 'image|file|max:2048']);
            if ($request->old_pic) {
                storage::delete($request->old_pic);
                $group->image()->delete();
            }
            $group->image()->create([
                'pic' => $request->file('pic')->store('group-pic'),
            ]);
        }
        return redirect('dashboard/unit/group')->with(
            'Success',
            'data Has Been Updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->destroy($group->id);
        if ($group->image) {
            storage::delete($group->image->pic);
            $group->image->delete();
        }

        return redirect('/dashboard/unit/group')->with(
            'success',
            'Data Has Been Deleted'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Group::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
