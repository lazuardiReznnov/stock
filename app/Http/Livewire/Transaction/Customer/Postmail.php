<?php

namespace App\Http\Livewire\Transaction\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models;

class Postmail extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $customerId;
    public $pic, $address;

    protected function rules()
    {
        return [
            'pic' => 'required',
            'address' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveCustomerPostmail()
    {
        $validatedData = $this->validate();
        $validatedData['customer_id'] = $this->customerId;

        Models\Postmail::create($validatedData);
        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        return view('livewire.transaction.customer.postmail', [
            'datas' => Models\Postmail::where('customer_id', $this->customerId)
                ->with('customer')
                ->get(),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->pic = '';
        $this->address = '';
        $this->resetValidation();
    }
}
