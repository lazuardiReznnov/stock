<?php

namespace App\Http\Livewire\Transaction\Rate\Region;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\region;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $regionId, $name, $description;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.transaction.rate.region.index', [
            'datas' => region::latest()
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
        $this->regionId = '';
        $this->name = '';
        $this->description = '';

        $this->resetValidation();
    }
}
