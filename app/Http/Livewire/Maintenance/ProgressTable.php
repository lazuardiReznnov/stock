<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\statelog;
use App\Models\Maintenance;

class ProgressTable extends Component
{
    public $maintenanceId;
    protected $listeners = [
        'dataStored' => 'handleStored',
    ];

    public function render()
    {
        return view('livewire.maintenance.progress-table', [
            'statelog' => statelog::where(
                'maintenance_id',
                $this->maintenanceId
            )->get(),
            'progress' => Maintenance::find($this->maintenanceId),
        ]);
    }

    public function handleStored($datas)
    {
    }
}
