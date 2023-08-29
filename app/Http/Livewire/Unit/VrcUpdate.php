<?php

namespace App\Http\Livewire\Unit;

use App\Models\Vrc;
use Livewire\Component;

class VrcUpdate extends Component
{
    public $unitId;

    public function render()
    {
        return view('livewire.unit.vrc-update', [
            'data' => Vrc::where('unit_id', $this->unitId)->first(),
        ]);
    }
}
