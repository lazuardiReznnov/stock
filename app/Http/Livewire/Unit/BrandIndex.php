<?php

namespace App\Http\Livewire\Unit;

use App\Models\Brand;
use App\Models\Image;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class BrandIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $pic;
    public $name;
    public $description;
    public $brandId;
    public $oldPic, $oldPicId;

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

    public function editBrand($brandId)
    {
        $brand = Brand::find($brandId);
        if ($brand) {
            $this->brandId = $brand->id;
            $this->name = $brand->name;
            $this->description = $brand->description;
            if ($brand->image) {
                $this->oldPic = $brand->image->pic;
                $this->oldPicId = $brand->image->id;
            }
        } else {
            return redirect()->to('/unit/brand');
        }
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $brand = Brand::find($this->brandId);
        $brand->update($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $brand->image()->delete();
                Image::where('id', $this->oldPicId)->delete();
            }
            $data['pic'] = $this->pic->store('Brand-Pic');
            $brand->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteBrand(int $brandId)
    {
        $this->brandId = $brandId;
    }

    public function destroyBrand()
    {
        $brand = Brand::find($this->brandId);
        if ($brand->image) {
            storage::delete($brand->image->pic);
            $brand->image->delete();
        }
        $brand->delete();
        session()->flash('success', 'Data Has Been Deleted');

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
