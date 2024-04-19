<?php

namespace App\Http\Livewire\Transaction\Rate\Region;

use App\Models\region;
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
    public $regionId, $name, $description;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function saveRegion()
    {
        $this->rules['name'] = 'required|unique:regions';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        region::create($validatedData);

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editRegion($regionId)
    {
        $region = region::find($regionId);
        if ($region) {
            $this->name = $region->name;
            $this->description = $region->description;
            $this->regionId = $region->id;
        } else {
            return redirect()->to('/transaction/rate/');
        }
    }

    public function updateRegion()
    {
        $region = region::find($this->regionId);

        if ($this->name != $region->name) {
            $this->rules['name'] = 'required|unique:regions';
        }
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $region->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteRegion(int $regionId)
    {
        $this->regionId = $regionId;
    }

    public function destroyRegion()
    {
        $region = region::find($this->regionId);
        $region->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
