<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\statelog;

class ProgressUpdate extends Component
{
    public $name;
    public $description;

    public $maintenanceId;
    public $stateId;

    protected $listeners = [
        'getState' => 'showState',
    ];

    public function render()
    {
        return view('livewire.maintenance.progress-update');
    }

    public function showState($statelog)
    {
        $this->name = $statelog['name'];
        $this->description = $statelog['description'];
        $this->maintenanceId = $statelog['maintenance_id'];
        $this->stateId = $statelog['id'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($this->stateId) {
            $statelog = statelog::find($this->stateId);
            $statelog->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->resetInput();
            $this->emit('dataUpdated', $statelog);
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->description = null;
    }
}
