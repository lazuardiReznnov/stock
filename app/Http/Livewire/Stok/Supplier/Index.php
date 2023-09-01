<?php

namespace App\Http\Livewire\Stok\Supplier;

use App\Models\Supplier;
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
    public $supplierId, $name, $phone, $email, $address, $oldPic, $pic;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'name' => 'required|min:6',
        'phone' => 'required|min:6',
        'email' => 'required|email:rfc,dns',
        'address' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveSupplier()
    {
        $this->rules['name'] = 'required|unique:suppliers|min:6';
        $this->rules['email'] = 'required|unique:suppliers|email:rfc,dns';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $supplier = Supplier::create($validatedData);
        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            $data['pic'] = $this->pic->store('supplier-Pic');
            $supplier->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editSupplier($supplierId)
    {
        $supplier = Supplier::find($supplierId);

        if ($supplier) {
            $this->name = $supplier->name;
            $this->phone = $supplier->phone;
            $this->email = $supplier->email;
            $this->address = $supplier->address;
            $this->supplierId = $supplier->id;

            if ($supplier->image) {
                $this->oldPic = $supplier->image->pic;
            }
        } else {
            return redirect()->to('/stock/supplier');
        }
    }

    public function updateSupplier()
    {
        $supplier = Supplier::find($this->supplierId);
        if ($supplier->name != $this->name) {
            $this->rules['name'] = 'required|unique:suppliers';
        }
        if ($supplier->email != $this->email) {
            $this->rules['email'] = 'required|unique:suppliers';
        }

        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        if ($this->pic) {
            $data = $this->validate([
                'pic' => 'image|file|max:2048',
            ]);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $supplier->image()->delete();
            }
            $data['pic'] = $this->pic->store('supplier-Pic');
            $supplier->image()->create($data);
        }
        $supplier->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteSupplier(int $supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function destroySupplier()
    {
        $supplier = Supplier::find($this->supplierId);
        if ($supplier->image) {
            storage::delete($supplier->image->pic);
            $supplier->image->delete();
        }
        $supplier->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.stok.supplier.index', [
            'datas' => Supplier::where(
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
        $this->pic = '';
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->email = '';
        $this->reset();
        $this->resetValidation();
    }
}
