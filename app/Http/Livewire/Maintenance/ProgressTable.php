<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\statelog;
use App\Models\Maintenance;

class ProgressTable extends Component
{
    public $statusUpdate = false;
    public $maintenanceId;
    protected $listeners = [
        'dataStored' => 'handleStored',
        'dataUpdated' => 'handleUpdated',
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

    public function getState($id)
    {
        $this->statusUpdate = true;
        $statelog = statelog::find($id);
        $this->emit('getState', $statelog);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = statelog::find($id);
            $data->delete();
            $data->maintenance()->update(['progress' => 0]);
            session()->flash('success', 'Data Has Been Deleted');
        }
    }
    public function handleStored($datas)
    {
        session()->flash('success', 'Data Has Been Added');
    }

    public function handleUpdatedgit($datas)
    {
        session()->flash('success', 'Data Has Been Updated');
        $this->statusUpdate = false;
    }
}
