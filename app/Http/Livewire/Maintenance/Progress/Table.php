<?php

namespace App\Http\Livewire\Maintenance\Progress;

use App\Models\Maintenance;
use Livewire\Component;
use App\Models\statelog;

class Table extends Component
{
    public $maintenanceId;
    public function render()
    {
        return view('livewire.maintenance.progress.table', [
            'statelog' => statelog::where(
                'maintenance_id',
                $this->maintenanceId
            )->get(),
            'progress' => Maintenance::find($this->maintenanceId),
        ]);
    }
}
