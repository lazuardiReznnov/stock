<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\employee;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name,
        $identity,
        $address,
        $email,
        $phone,
        $birth,
        $born,
        $gender,
        $martial,
        $relegion,
        $weight,
        $height,
        $driver_license,
        $tin,
        $skill,
        $position,
        $entry,
        $pic,
        $oldPic,
        $division_id;

    public function mount($divisionId)
    {
        $this->division_id = $divisionId;
    }

    protected $rules = [
        'name' => 'required|min:6',
        'identity' => 'required|min:12|numeric',
        'email' => 'required|email:rfc,dns',
        'phone' => 'required|min:4',
        'birth' => 'required',
        'born' => 'required',
        'gender' => 'required',
        'martial' => 'required',
        'relegion' => 'required',
        'weight' => 'required',
        'height' => 'required',
        'driver_license' => 'required|min:5',
        'tin' => 'required|min:5|numeric',
        'skill' => 'required',
        'position' => 'required',
        'entry' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveEmployee()
    {
        $this->rules['name'] = 'required|unique:employees';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);
        $validatedData['division_id'] = $this->division_id;

        $employee = employee::create($validatedData);

        if ($this->pic) {
            $data = $this->validate(['pic' => 'image|file|max:2048']);
            $data['pic'] = $this->pic->store('employee-Pic');
            $employee->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employee.index', [
            'datas' => employee::where('division_id', $this->division_id)
                ->latest()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->identity = '';
        $this->address = '';
        $this->email = '';
        $this->phone = '';
        $this->pic = '';
        $this->birth = '';
        $this->born = '';
        $this->gender = '';
        $this->martial = '';
        $this->relegion = '';
        $this->weight = '';
        $this->height = '';
        $this->driver_license = '';
        $this->tin = '';
        $this->skill = '';
        $this->position = '';
        $this->entry = '';
        $this->oldPic = '';
        $this->resetValidation();
    }
}
