<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class CustomerIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        return view('livewire.transaction.customer-index', [
            'datas' => Customer::where(
                'name',
                'like',
                '%' . $this->search . '%'
            )
                ->latest()
                ->paginate(10),
        ]);
    }
}
