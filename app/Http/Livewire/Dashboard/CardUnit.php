<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Unit;
use Livewire\Component;

class CardUnit extends Component
{
    public function render()
    {
        $units = Unit::get();
        return view('livewire.dashboard.card-unit', [
            'units' => $units,
        ]);
    }
}
