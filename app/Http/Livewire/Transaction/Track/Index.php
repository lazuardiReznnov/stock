<?php

namespace App\Http\Livewire\Transaction\Track;

use App\Models\Customer;
use App\Models\Invoicing;
use App\Models\region;
use App\Models\transaction;
use App\Models\Unit;
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
        $trackId;

    public function mount()
    {
        $this->customers = Customer::all();
        $this->regions = region::all();
        $this->units = Unit::all();
        $this->invoicings = Invoicing::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $track = transaction::latest();
        return view('livewire.transaction.track.index', [
            'datas' => $track
                ->with('region', 'unit', 'invoicing', 'customer')

                ->where('name', 'like', '%' . $this->search . '%')

                ->paginate(10),
        ]);
    }
}
