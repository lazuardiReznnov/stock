<?php

namespace App\Http\Livewire\Unit;

use App\Models\Spesification;
use Livewire\Component;

class SpecUpdate extends Component
{
    public $unitId;
    public $vin, $en, $year, $color, $model, $fuel, $cylinder, $specId;

    protected $rules = [
        'vin' => 'required|min:3',
        'en' => 'required|min:3',
        'year' => 'required',
        'color' => 'required',
        'model' => 'required',
        'fuel' => 'required',
        'cylinder' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editSpec($unitId)
    {
        $spec = Spesification::where('unit_id', $unitId)->first();

        if ($spec) {
            $this->unitId = $spec->unit_id;
            $this->vin = $spec->vin;
            $this->en = $spec->en;
            $this->year = $spec->year;
            $this->color = $spec->color;
            $this->model = $spec->model;
            $this->fuel = $spec->fuel;
            $this->cylinder = $spec->cylinder;
            $this->specId = $spec->id;
        }
    }
    public function mount($unitId)
    {
        $this->unitId = $unitId;
    }

    public function updateSpec()
    {
        $spec = Spesification::find($this->specId);

        $validatedData = $this->validate();

        $spec->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.unit.spec-update', [
            'spec' => Spesification::where('unit_id', $this->unitId)->first(),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->vin = '';
        $this->en = '';
        $this->year = null;
        $this->color = '';
        $this->model = '';
        $this->fuel = '';
        $this->cylinder = '';
        $this->specId = '';
        $this->resetValidation();
    }
}
