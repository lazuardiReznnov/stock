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
    public $region_id, $name, $fare, $type, $rateId;
    public $regions;
    public $customerId;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount($customerId)
    {
        $this->customerId = $customerId;
        $this->regions = region::all();
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

    public function editRate($rateId)
    {
        $rate = rate::find($rateId);
        if ($rate) {
            $this->customerId = $rate->customer_id;
            $this->region_id = $rate->region_id;
            $this->name = $rate->name;
            $this->fare = $rate->fare;
            $this->type = $rate->type;
            $this->rateId = $rate->id;
        } else {
            return redirect()->to('/transaction/rate/');
        }
    }

    public function updateRate()
    {
        $rate = rate::find($this->rateId);

        if ($this->name != $rate->name) {
            $this->rules['name'] = 'required|unique:rates';
        }
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $rate->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteRate(int $rateId)
    {
        $this->rateId = $rateId;
    }

    public function destroyRate()
    {
        $rate = rate::find($this->rateId);
        $rate->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        if ($this->customerId == '') {
            dd($this->customerId);
        }
        $rate = Rate::where('customer_id', $this->customerId)->latest();
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
        $this->name = '';
        $this->region_id = null;
        $this->name = '';
        $this->fare = '';
        $this->type = '';

        $this->resetValidation();
    }
}
