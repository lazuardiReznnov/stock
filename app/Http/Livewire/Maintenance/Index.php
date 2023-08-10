<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\Unit;
use Livewire\Component;
use App\Models\Maintenance;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $units;
    public $unit_id,
        $name,
        $slug,
        $tgl,
        $estimate,
        $mechanic,
        $description,
        $instruction;
    public $maintenanceId;

    protected function rules()
    {
        return [
            'unit_id' => 'required',
            'tgl' => 'required',
            'estimate' => 'required',
            'mechanic' => 'required',
            'description' => 'required',
            'instruction' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function saveMaintenance()
    {
        $validatedData = $this->validate();

        $date = date('Ymd');
        $unit_name = $this->unit_id;
        $rand = rand(0, 100);

        $name = $date . $unit_name . $rand;
        $slug = $date . '-' . $unit_name . '-' . $rand;

        $validatedData['name'] = $name;
        $validatedData['slug'] = $slug;

        Maintenance::create($validatedData);
        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editMaintenance($mainteanceId)
    {
        $maintenance = Maintenance::find($mainteanceId);
        if ($maintenance) {
            $this->unit_id = $maintenance->unit_id;
            $this->tgl = $maintenance->tgl;
            $this->maintenanceId = $maintenance->id;
            $this->estimate = $maintenance->estimate;
            $this->mechanic = $maintenance->mechanic;
            $this->description = $maintenance->description;
            $this->instruction = $maintenance->instruction;
        } else {
            return redirect()->to('/maintenance');
        }
    }

    public function updateMaintenance()
    {
        $validatedData = $this->validate();
        Maintenance::where('id', $this->maintenanceId)->update([
            'unit_id' => $validatedData['unit_id'],
            'tgl' => $validatedData['tgl'],
            'description' => $validatedData['description'],
            'instruction' => $validatedData['instruction'],
            'mechanic' => $validatedData['mechanic'],
            'estimate' => $validatedData['estimate'],
        ]);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function mount()
    {
        $this->units = Unit::all();
    }

    public function render()
    {
        $maintenance = Maintenance::latest();

        // if ($this->search) {
        //     $pisah = explode('-', $this->search);

        //     $maintenance
        //         ->whereMonth('tgl', '=', $pisah[1])
        //         ->whereYear('tgl', '=', $pisah[0]);
        // } else {
        //     $maintenance
        //         ->whereMonth('tgl', '=', $datem)
        //         ->whereYear('tgl', '=', $datey);
        // }
        // $maintenance->when($request->search, function ($query) use ($request) {
        //     return $query->where('name', 'like', '%' . $request->search . '%');
        // });

        return view('livewire.maintenance.index', [
            'datas' => $maintenance
                ->with('unit')
                ->where('tgl', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->unit_id = '';
        $this->tgl = '';
        $this->instruction = '';
        $this->description = '';
        $this->estimate = '';
        $this->mechanic = '';
    }
}
