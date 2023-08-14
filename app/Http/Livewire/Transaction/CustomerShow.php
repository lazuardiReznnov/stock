<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class CustomerShow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public function render()
    {
        return view('livewire.transaction.customer-show', [
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
