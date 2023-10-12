<?php

namespace App\Http\Livewire\Employee\Division;

use Livewire\Component;
use App\Models\Division;

class Index extends Component
{
    public $name;
    public $description;
    public $pic;
    public $oldPic;

    public function render()
    {
        return view('livewire.employee.division.index', [
            'datas' => Division::all(),
        ]);
    }
}
