<?php

namespace App\Http\Livewire\Employee\Division;

use Livewire\Component;
use App\Models\Division;
use Illuminate\Support\Str;

class Index extends Component
{
    public $name;
    public $description;
    public $pic;
    public $oldPic;

    protected $rules = [
        'name' => 'required|min:6',
        'description' => 'required|min:5',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveDivision()
    {
        $this->rules['name'] = 'required|unique:types';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        Division::create($validatedData);

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.employee.division.index', [
            'datas' => Division::all(),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->pic = '';
        $this->name = '';
        $this->description = '';
        $this->reset();
        $this->resetValidation();
    }
}
