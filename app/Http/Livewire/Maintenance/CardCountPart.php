<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\MaintenancePart;
use Livewire\Component;

class CardCountPart extends Component
{
    public function render()
    {
        $part = MaintenancePart::latest();

        return view('livewire.maintenance.card-count-part', [
            'parts' => $part,
        ]);
    }
}
