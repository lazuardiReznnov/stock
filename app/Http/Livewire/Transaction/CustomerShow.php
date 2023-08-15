<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class CustomerShow extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name,
        $phone,
        $address,
        $email,
        $industry,
        $pic,
        $oldPic,
        $picId,
        $customerId;

    public function updatingSearch()
    {
        $this->resetPage();
    }

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

    public function editCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->customerId = $customer->id;
            $this->name = $customer->name;
            $this->address = $customer->address;
            $this->phone = $customer->phone;
            $this->email = $customer->email;
            $this->industry = $customer->industry;

            if ($customer->image) {
                $this->oldPic = $customer->image->pic;
                $this->picId = $customer->image->id;
            } else {
                return redirect()->to('/transaction/customer');
            }
        }
    }

    public function updateCustomer()
    {
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $customer = Customer::find($this->customerId);

        $customer->update($validatedData);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $customer->image()->delete();
            }
            $data['pic'] = $this->pic->store('Customer-Pic');
            $customer->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteCustomer(int $customerId)
    {
        $this->customerId = $customerId;
    }

    public function destroyCustomer()
    {
        $customer = Customer::find($this->customerId);
        if ($customer->image) {
            storage::delete($customer->image->pic);
            $customer->image->delete();
        }
        $customer->delete();
        session()->flash('success', 'Data Has Been Deleted');

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
