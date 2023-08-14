<?php

namespace App\Http\Livewire\Maintenance;

use Livewire\Component;
use App\Models\Maintenance;
use App\Models\MaintenancePart;

class CardCountPart extends Component
{
    public function render()
    {
        $datey = date('Y');
        $datem = date('m');
        $maintenancePart = Maintenance::with('maintenancePart')->latest();
        $countAll = $maintenancePart->get();
        $countMount = $maintenancePart
            ->whereMonth('tgl', '=', $datem)
            ->whereYear('tgl', '=', $datey)
            ->get();
        $ttlMount = 0;
        foreach ($countMount as $cm) {
            foreach ($cm->maintenancePart as $cmp) {
                $jmlMount = $cmp->qty * $cmp->price;
                $ttlMount = $ttlMount + $jmlMount;
            }
        }
        $ttlAll = 0;

        foreach ($countAll as $ca) {
            foreach ($ca->maintenancePart as $cap) {
                $jmlAll = $cap->qty * $cap->price;
                $ttlAll = $ttlAll + $jmlAll;
            }
        }

        return view('livewire.maintenance.card-count-part', [
            'countMounth' => $ttlMount,
            'countAll' => $ttlAll,
        ]);
    }
}
