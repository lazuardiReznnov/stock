<?php

namespace App\Http\Livewire\Transaction\Rate;

use App\Models\Rate;
use Livewire\Component;
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
    public $customerId, $regionId, $name, $fare, $type;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($customerId)
    {
        $this->customerId = $customerId;
    }
    public function render()
    {
        return view('livewire.transaction.rate.index', [
            'datas' => Rate::where('customer_id', $this->customerId)
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
        $this->customerId = '';
        $this->name = '';
        $this->regionId = '';
        $this->name = '';
        $this->fare = '';
        $this->type = '';
        $this->reset();
        $this->resetValidation();
    }
}
