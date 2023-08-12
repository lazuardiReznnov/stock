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
        $part = Maintenance::latest()->with('maintenancePart');
        $partMonth = $part
            ->whereMonth('tgl', '=', $datem)
            ->whereYear('tgl', '=', $datey)
            ->get();

        $ttlm = 0;
        foreach ($partMonth as $pm) {
            foreach ($pm->maintenancePart as $p) {
                $jml = $p->qty * $p->price;
                $ttlm = $ttlm + $jml;
            }
        }
        $ttla = 0;
        foreach ($part as $pt) {
            foreach ($pt->maintenancePart as $mpt) {
                $jmla = $mpt->qty * $mpt->price;
                $ttla = $ttla + $jmla;
            }
        }
        return view('livewire.maintenance.card-count-part', [
            'parts' => $ttla,
            'partMonths' => $ttlm,
        ]);
    }
}
