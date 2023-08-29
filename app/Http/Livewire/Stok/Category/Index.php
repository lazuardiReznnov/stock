<?php

namespace App\Http\Livewire\Stok\Category;

use Livewire\Component;
use App\Models\Category;
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
    public $name;
    public $description;
    public $categoryId, $oldPic, $pic;

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

    public function saveCategory()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $category = Category::create($validatedData);
        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('Category-Pic');
            $category->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            if ($category->image) {
                $this->oldPic = $category->image->pic;
            }
        } else {
            return redirect()->to('/unit/category');
        }
    }

    public function updateCategory()
    {
        $category = Category::find($this->categoryId);

        if ($category->name != $this->name) {
            $this->rules['name'] = 'required|unique:categorys';
        }

        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $category->update($validatedData);

        if ($this->pic) {
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $category->image()->delete();
            }
            $pic = $this->pic->store('category-Pic');
            $category->image()->create(['pic' => $pic]);
        }

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteCategory(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->categoryId);
        if ($category->image) {
            storage::delete($category->image->pic);
            $category->image->delete();
        }
        $category->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.stok.category.index', [
            'datas' => Category::where(
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
        $this->reset();
        $this->resetValidation();
    }
}
