<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\Maintenance;
use App\Models\Stock;
use Livewire\Component;
use App\Models\MaintenancePart;

class SparepartIndex extends Component
{
    public $maintenanceId,
        $stocks,
        $price,
        $sparepart_id,
        $qty,
        $description,
        $maintenanceSparepartId;

    public function mount($maintenanceId)
    {
        $this->maintenanceId = $maintenanceId;
        $this->stocks = Stock::with('sparepart')->get();
    }

    protected function rules()
    {
        return [
            'sparepart_id' => 'required',
            'qty' => 'required',
            'description' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveMaintenanceSparepart()
    {
        $validatedData = $this->validate();

        $stock = Stock::find($this->sparepart_id);

        $validatedData['maintenance_id'] = $this->maintenanceId;
        $validatedData['price'] = $stock->price;
        $validatedData['sparepart_id'] = $stock->sparepart_id;

        MaintenancePart::create($validatedData);

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editMaintenanceSparepart($maintenanceSparepartId)
    {
        $maintenanceSparepart = MaintenancePart::find($maintenanceSparepartId);

        if ($maintenanceSparepart) {
            $this->maintenanceSparepartId = $maintenanceSparepart->id;
            $this->maintenanceId = $maintenanceSparepart->maintenance_id;
            $this->qty = $maintenanceSparepart->qty;
            $this->description = $maintenanceSparepart->description;
            $this->sparepart_id = $maintenanceSparepart->sparepart->id;
        }
    }

    public function updateMaintenanceSparepart()
    {
        $maintenanceSparepart = MaintenancePart::find(
            $this->maintenanceSparepartId
        );

        $stock = Stock::where('sparepart_id', $this->sparepart_id)->first();

        $validatedData['maintenance_id'] = $this->maintenanceId;
        $validatedData['price'] = $stock->price;
        $validatedData['sparepart_id'] = $stock->sparepart_id;

        $maintenanceSparepart->update($validatedData);
    }

    public function deleteMaintenanceSparepart(int $maintenanceSparepartId)
    {
        $this->maintenanceSparepartId = $maintenanceSparepartId;
    }

    public function destroyMaintenanceSparepart()
    {
        $maintenanceSparepart = MaintenancePart::find(
            $this->maintenanceSparepartId
        );

        $maintenanceSparepart->delete();

        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $sparepart = MaintenancePart::where(
            'maintenance_id',
            $this->maintenanceId
        )->get();

        return view('livewire.maintenance.sparepart-index', [
            'data' => $sparepart,
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->sparepart_id = '';
        $this->qty = '';
        $this->description = '';
        $this->resetValidation();
    }
}
