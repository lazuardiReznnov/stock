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
        return view('livewire.unit.unit-maintenance', [
            'datas' => Maintenance::where(
                'tgl',
                'like',
                '%' . $this->search . '%'
            )
                ->with('unit')
                ->where(['unit_id' => $this->unitId])
                ->paginate(10),
        ]);
    }
}
