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
<<<<<<< HEAD
        $part = Maintenance::latest()->with('maintenancePart');
        $partMonth = $part
            ->whereMonth('tgl', '=', $datem)
            ->whereYear('tgl', '=', $datey)
            ->get();
=======
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
>>>>>>> 4c78f0b8c1fead7754a52ccca02b7998da6193ca

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
<<<<<<< HEAD
            'parts' => $ttla,
            'partMonths' => $ttlm,
=======
            'countMounth' => $ttlMount,
            'countAll' => $ttlAll,
>>>>>>> 4c78f0b8c1fead7754a52ccca02b7998da6193ca
        ]);
    }
}
