<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CustomerShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name, $phone, $address, $email, $industry, $pic, $oldPic, $picId;

    protected function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'industry' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveCustomer()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $customer = Customer::create($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('Customer-Pic');
            $customer->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.transaction.customer-show', [
            'datas' => Customer::where(
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
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->industry = '';
        $this->email = '';
        $this->pic = '';
    }
}
