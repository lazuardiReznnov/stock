<?php

namespace App\Http\Livewire\Transaction\Track;

use App\Models\Customer;
use App\Models\Invoicing;
use App\Models\Rate;
use App\Models\region;
use App\Models\transaction;
use App\Models\Unit;
use Database\Seeders\RegionSeeder;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public $customers;
    public $regions;
    public $units;
    public $invoicings;

    public $name,
        $letter_number,
        $recipient,
        $address,
        $type,
        $weight,
        $cos,
        $transport,
        $driver_fee,
        $mark_fee,
        $inline_fee,
        $trackId,
        $region,
        $unit_id,
        $customer_id,
        $rates,
        $selectedRegions,
        $selectedCustomers,
        $rate_id,
        $rateId,
        $fare,
        $area,
        $driver;

    protected $rules = [
        'driver' => 'required',
        'region' => 'required',
        'unit_id' => 'required',
        'type' => 'required',
        'fare' => 'required',
    ];
    public function mount()
    {
        $this->customers = Customer::all();
        $this->regions = region::all();
        $this->units = Unit::all();
        $this->invoicings = Invoicing::all();
        $this->rates = collect();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSelectedCustomers($customerId)
    {
        return $this->rates = Rate::where('customer_id', $customerId)->get();
    }

    public function updatedRateId($rate_id)
    {
        $type = Rate::find($rate_id);
        $region = Region::find($type->region_id);
        $this->region = $region->name;
        $this->type = $type->type;
        $this->fare = $type->fare;
    }
    public function render()
    {
        $track = transaction::latest();
        return view('livewire.transaction.track.index', [
            'datas' => $track
                ->with('customer', 'unit')

                ->where('name', 'like', '%' . $this->search . '%')

                ->paginate(10),
        ]);
    }

    public function saveTrack()
    {
        $validatedData = $this->validate();
        $cusName = Customer::find($this->selectedCustomers);
        $unitName = Unit::find($this->unit_id);
        $validatedData['name'] =
            rand(10, 100) .
            $cusName->name .
            $unitName->name .
            date('Y-m-d H:i:s');
        $validatedData['slug'] = str::slug($validatedData['name']);
        $validatedData['customer_id'] = $this->selectedCustomers;
        $validatedData['area'] = $this->rateId;
        transaction::create($validatedData);
        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editTrack($trackId)
    {
        $track = transaction::find($trackId);
        if ($track) {
            $this->rates = Rate::where(
                'customer_id',
                $track->customer_id
            )->get();
            $this->rateId = $track->area;
            $this->unit_id = $track->unit_id;
            $this->selectedCustomers = $track->customer_id;
            $this->region = $track->region;
            $this->type = $track->type;
            $this->fare = $track->fare;
            $this->trackId = $trackId;
        } else {
            return redirect()->to('/transaction/tack/');
        }
    }

    public function updateTrack()
    {
        $validatedData = $this->validate();
        $transaction = transaction::find($this->trackId);

        $validatedData['customer_id'] = $this->selectedCustomers;
        $validatedData['area'] = $this->rateId;

        $transaction->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteTrack(int $trackId)
    {
        $this->trackId = $trackId;
    }

    public function destroyTrack()
    {
        $track = transaction::find($this->trackId);
        $track->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->region = '';
        $this->name = '';
        $this->letter_number = '';
        $this->recipient = '';
        $this->address = '';
        $this->type = '';
        $this->weight = '';
        $this->cos = '';
        $this->transport = '';
        $this->driver_fee = '';
        $this->mark_fee = '';
        $this->inline_fee = '';
        $this->trackId = '';
        $this->unit_id = '';
        $this->selectedCustomers = null;
        $this->rateId = null;

        $this->resetValidation();
    }
}
