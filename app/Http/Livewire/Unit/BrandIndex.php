<?php

namespace App\Http\Livewire\Unit;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class BrandIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $pic;
    public $name;
    public $description;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveBrand()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $brand = Brand::create($validatedData);
        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('Brand-Pic');
            $brand->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.unit.brand-index', [
            'datas' => Brand::where('name', 'like', '%' . $this->search . '%')
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
    }
}
