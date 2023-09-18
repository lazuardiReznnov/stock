<?php

namespace App\Http\Livewire\Unit;

use Livewire\Component;
use App\Models\Maintenance;
use Livewire\WithPagination;

class UnitMaintenance extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $unitId;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($unitId)
    {
        $this->unitId = $unitId;
    }
    public function render()
    {
        $datey = date('Y');
        $datem = date('m');
        $maintenance = Maintenance::latest();

        if ($this->search) {
            $maintenance->where('tgl', 'like', '%' . $this->search . '%');
        } else {
            $maintenance
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey);
        }
        return view('livewire.unit.unit-maintenance', [
            'datas' => $maintenance
                ->with('unit')
                ->where(['unit_id' => $this->unitId])
                ->paginate(10),
        ]);
    }
}
