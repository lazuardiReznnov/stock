<?php

namespace App\Http\Livewire\Unit;

use App\Models\Group;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class GroupIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $pic;
    public $name;
    public $description;
    public $groupId;
    public $oldPic, $oldPicId, $iteration;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'name' => 'required|min:6',
        'description' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveGroup()
    {
        $this->rules['name'] = 'required|unique:groups';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $group = Group::create($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('group-Pic');
            $group->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editGroup($groupId)
    {
        $group = Group::find($groupId);

        if ($group) {
            $this->name = $group->name;
            $this->description = $group->description;
            $this->groupId = $group->id;

            if ($group->image) {
                $this->oldPic = $group->image->pic;
                $this->oldPicId = $group->image->id;
            }
        } else {
            return redirect()->to('/unit/group');
        }
    }

    public function updateGroup()
    {
        $group = Group::find($this->groupId);
        if ($group->name != $this->name) {
            $this->rules['name'] = 'required|unique:groups';
        }

        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $group->image()->delete();
            }
            $data['pic'] = $this->pic->store('group-Pic');
            $group->image()->create($data);
        }
        $group->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteGroup(int $groupId)
    {
        $this->groupId = $groupId;
    }

    public function destroyGroup()
    {
        $group = Group::find($this->groupId);
        if ($group->image) {
            storage::delete($group->image->pic);
            $group->image->delete();
        }
        $group->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.unit.group-index', [
            'datas' => Group::where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->pic = '';
        $this->name = '';
        $this->description = '';
        $this->reset();
        $this->resetValidation();
    }
}
