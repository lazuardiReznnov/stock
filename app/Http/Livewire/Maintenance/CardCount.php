<?php

namespace App\Http\Livewire\Maintenance;

use App\Models\Maintenance;
use Livewire\Component;

class CardCount extends Component
{
    public function render()
    {
        $datey = date('Y');
        $datem = date('m');
        $maintenance = Maintenance::latest();
        $ttlCount = $maintenance->count();
        $countMount = $maintenance
            ->whereMonth('tgl', '=', $datem)
            ->whereYear('tgl', '=', $datey)
            ->get();

        return view('livewire.maintenance.card-count', [
            'counts' => $ttlCount,
            'countMounth' => $countMount,
        ]);
    }
}
