<?php

namespace App\Http\Livewire\Unit;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CategoryUnit;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class CategoryUnitIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $pic;
    public $name;
    public $description;
    public $categoryUnitId;
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

    public function saveCategoryUnit()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $categoryUnit = CategoryUnit::create($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('category-Pic');
            $categoryUnit->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCategoryUnit($categoryUnitId)
    {
        $categoryUnit = CategoryUnit::find($categoryUnitId);
        if ($categoryUnit) {
            $this->categoryUnitId = $categoryUnit->id;
            $this->name = $categoryUnit->name;
            $this->description = $categoryUnit->description;
            if ($categoryUnit->image) {
                $this->oldPic = $categoryUnit->image->pic;
                $this->oldPicId = $categoryUnit->image->id;
            }
        } else {
            return redirect()->to('/unit/brand');
        }
    }

    public function updateCategoryUnit()
    {
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $categoryUnit = CategoryUnit::find($this->categoryUnitId);
        $categoryUnit->update($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $categoryUnit->image()->delete();
            }
            $data['pic'] = $this->pic->store('categoryUnit-Pic');
            $categoryUnit->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteCategoryUnit(int $categoryUnitId)
    {
        $this->categoryUnitId = $categoryUnitId;
    }

    public function destroyCategoryUnit()
    {
        $categoryUnit = CategoryUnit::find($this->categoryUnitId);
        if ($categoryUnit->image) {
            storage::delete($categoryUnit->image->pic);
            $categoryUnit->image->delete();
        }
        $categoryUnit->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.unit.category-unit-index', [
            'datas' => CategoryUnit::where(
                'name',
                'like',
                '%' . $this->search . '%'
            )
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
