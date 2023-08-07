<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\Maintenance;
use App\Models\statelog;
use Livewire\Component;

class ProgressCreate extends Component
{
    public $name;
    public $description;
    public $progress;
    public $maintenanceId;

    public function render()
    {
        return view('livewire.maintenance.progress-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'progress' => 'required',
        ]);

        $state = statelog::create([
            'maintenance_id' => $this->maintenanceId,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        Maintenance::where('id', $this->maintenanceId)->update([
            'progress' => $this->progress,
        ]);

        $this->resetInput();

        $this->emit('dataStored', $state);

        session()->flash('success', 'Data Has Been Added');
    }

    private function resetInput()
    {
        $this->name = null;
        $this->description = null;
        $this->progress = null;
    }
}
