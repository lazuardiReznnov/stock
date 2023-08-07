<?php

namespace App\Http\Livewire\Maintenance\Progress;

use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public $progress;

    public function render()
    {
        return view('livewire.maintenance.progress.create');
    }

    public function store()
    {
    }
}
