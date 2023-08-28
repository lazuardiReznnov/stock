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
        'brand_id ' => 'required',
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
        dd($this->brand_id);
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
