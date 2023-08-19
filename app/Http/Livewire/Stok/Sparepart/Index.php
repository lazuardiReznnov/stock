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
        $description;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->types = collect();
    }

    protected function rules()
    {
        return [
            'category_id' => 'required',
            'type_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'selectedBrands' => 'required',
            'pic' => 'image|file|max:2048',
        ];
    }

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
        $this->type_id = '';
        $this->code = '';
        $this->pic = '';
        $this->description = '';
        $this->resetValidation();
    }
}
