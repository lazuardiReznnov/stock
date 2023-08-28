<?php

namespace App\Http\Livewire\Unit;

use App\Models\Type;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CategoryUnit;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class TypeIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $pic;
    public $name;
    public $brand_id;

    public $category_unit_id;
    public $description;
    public $typeId;
    public $oldPic;
    public $brands;
    public $categoryUnits;

    public function mount()
    {
        $this->brands = Brand::all();
        $this->categoryUnits = CategoryUnit::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'brand_id' => 'required',
        'category_unit_id' => 'required',
        'name' => 'required|min:6',
        'description' => 'required|min:5',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveType()
    {
        $this->rules['name'] = 'required|unique:types';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $type = Type::create($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('type-Pic');
            $type->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editType($typeId)
    {
        $type = Type::find($typeId);
        if ($type) {
            $this->typeId = $type->id;
            $this->brand_id = $type->brand_id;
            $this->category_unit_id = $type->category_unit_id;
            $this->name = $type->name;
            $this->description = $type->description;
            if ($type->image) {
                $this->oldPic = $type->image->pic;
            } else {
                return redirect()->to('/unit/brand');
            }
        }
    }

    public function updateType()
    {
        $type = Type::find($this->typeId);

        if ($type->name != $this->name) {
            $this->rules['name'] = 'required|unique:types';
        }
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $type->image()->delete();
            }
            $data['pic'] = $this->pic->store('type-Pic');
            $type->image()->create($data);
        }
        $type->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteType(int $typeId)
    {
        $this->typeId = $typeId;
    }

    public function destroyType()
    {
        $type = Type::find($this->typeId);
        if ($type->image) {
            storage::delete($type->image->pic);
            $type->image->delete();
        }
        $type->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.unit.type-index', [
            'datas' => Type::with('brand', 'categoryUnit', 'image')
                ->where('name', 'like', '%' . $this->search . '%')

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
        $this->category_unit_id = '';
        $this->brand_id = '';
        $this->description = '';
        $this->reset();
        $this->resetValidation();
    }
}
