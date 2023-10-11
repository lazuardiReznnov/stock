<?php

namespace App\Http\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class UnitIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $name,
        $type_id,
        $brand_id,
        $group_id,
        $description,
        $selectedBrand,
        $selectedCategory;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.unit.unit-index', [
            'datas' => Unit::with('type', 'group', 'image')
                ->where('name', 'like', '%' . $this->search . '%')

                ->latest()
                ->paginate(10),
        ]);
    }
}
