<?php

namespace App\Http\Livewire\Stok\Sparepart;

use App\Models\Type;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use App\Models\Sparepart;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $categories,
        $brands,
        $types,
        $selectedBrands,
        $pic,
        $category_id,
        $type_id,
        $name,
        $code,
        $description,
        $oldPic,
        $sparepartId;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->types = collect();
    }

    protected $rules = [
        'category_id' => 'required',
        'type_id' => 'required',
        'name' => 'required',
        'code' => 'required',
        'description' => 'required',
        'selectedBrands' => 'required',
        'pic' => 'image|file|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSelectedBrands($brandId)
    {
        if (!is_null($brandId)) {
            $this->types = Type::where('brand_id', $brandId)->get();
        }
    }

    public function saveSparepart()
    {
        $validatedData = $this->validate([
            'category_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'pic' => 'image|file|max:2048',
        ]);

        $validatedData['slug'] = Str::slug($this->name);

        $sparepart = Sparepart::create($validatedData);
        if ($this->pic) {
            $pic = $this->pic->store('Invoice-Stock-Pic');
            $sparepart->image()->create(['pic' => $pic]);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editSparepartStock($sparepartId)
    {
        $sparepart = Sparepart::find($sparepartId);
        if ($sparepart) {
            $this->category_id = $sparepart->category_id;
            $this->type_id = $sparepart->type_id;
            $this->selectedBrands = $sparepart->type->brand->id;
            $this->updatedSelectedBrands($this->selectedBrands);
            $this->name = $sparepart->name;
            $this->code = $sparepart->code;
            $this->description = $sparepart->description;
            $this->sparepartId = $sparepart->id;
            if ($sparepart->image) {
                $this->oldPic = $sparepart->image->pic;
            }
        } else {
            return redirect()->to('/stock/sparepart');
        }
    }
    public function updateSparepart()
    {
        $rules = [
            'category_id' => 'required',
            'type_id' => 'required',

            'code' => 'required',
            'description' => 'required',
        ];

        $sparepart = Sparepart::find($this->sparepartId);
        if ($this->name != $sparepart->name) {
            $rules['name'] = 'required|unique:spareparts';
        }
        $validatedData = $this->validate($rules);
        $validatedData['slug'] = Str::slug($this->name);

        if ($this->pic) {
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $sparepart->image()->delete();
            }
            $pic = $this->pic->store('sparepart-Pic');
            $sparepart->image()->create(['pic' => $pic]);
        }

        $sparepart->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.stok.sparepart.index', [
            'datas' => Sparepart::With('category', 'type')
                ->latest()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->selectedBrands = null;
        $this->category_id = null;
        $this->type_id = '';
        $this->code = '';
        $this->pic = '';
        $this->description = '';
        $this->resetValidation();
    }
}
