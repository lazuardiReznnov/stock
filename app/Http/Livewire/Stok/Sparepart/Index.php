<?php

namespace App\Http\Livewire\Stok\Sparepart;

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
    public $categories, $brands, $types;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->types = collect();
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
}
