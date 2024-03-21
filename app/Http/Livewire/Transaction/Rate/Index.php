<?php

namespace App\Http\Livewire\Transaction\Rate;

use App\Models\Rate;
use App\Models\region;
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
    public $customerId, $region_id, $name, $fare, $type;
    public $regions;

    public function mount($customerId)
    {
        $this->customerId = $customerId;
        $this->regions = region::all();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'region_id' => 'required',
        'name' => 'required',
        'fare' => 'required',
        'type' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveRate()
    {
        $this->rules['name'] = 'required|unique:rates';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);
        $validatedData['customer_id'] = $this->customerId;

        rate::create($validatedData);

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $rate = Rate::where('customer_id', '=', $this->customerId)->latest();
        return view('livewire.transaction.rate.index', [
            'datas' => $rate
                ->with('region')

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
        $this->customerId = '';
        $this->name = '';
        $this->region_id = null;
        $this->name = '';
        $this->fare = '';
        $this->type = '';
        $this->reset();
        $this->resetValidation();
    }
}
