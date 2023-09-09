<?php

namespace App\Http\Livewire\Unit;

use App\Models\Vpic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class VipcUpdate extends Component
{
    use WithFileUploads;
    public $unitId,
        $pic,
        $oldPic,
        $regnumber,
        $owner,
        $address,
        $region,
        $tgl_reg,
        $expire,
        $vpicId,
        $image;

    protected $rules = [
        'regnumber' => 'required|min:6',
        'owner' => 'required',
        'address' => 'required',
        'region' => 'required',
        'tgl_reg' => 'required',
        'expire' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editVpic($unitId)
    {
        $vpic = Vpic::where('unit_id', $unitId)->first();
        if ($vpic) {
            $this->vpicId = $vpic->id;
            $this->regnumber = $vpic->regnumber;
            $this->owner = $vpic->owner;
            $this->address = $vpic->address;
            $this->region = $vpic->region;
            $this->tgl_reg = $vpic->tgl_reg;
            $this->expire = $vpic->expire;
            if ($vpic->image) {
                $this->oldPic = $vpic->image->pic;
            }
        } else {
            return redirect()->to('/unit/show/' . $vpic->unit->slug);
        }
    }

    public function updateVpic()
    {
        $vpic = vpic::find($this->vpicId);
        if ($this->pic) {
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $vpic->image()->delete();
            }
            $data['pic'] = $this->pic->store('vpic-Pic');

            $vpic->image()->create($data);
        }
        $validatedData = $this->validate();

        $vpic->update($validatedData);
        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function showImageVpic($unitId)
    {
        $vpic = Vpic::where('unit_id', $unitId)
            ->with('image')
            ->first();

        if ($vpic->image) {
            $this->image = $vpic->image->pic;
        }
    }

    public function render()
    {
        return view('livewire.unit.vipc-update', [
            'data' => Vpic::where('unit_id', $this->unitId)->first(),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->pic = '';
        $this->regnumber = '';
        $this->owner = '';
        $this->address = '';
        $this->region = '';
        $this->tgl_reg = '';
        $this->expire = '';
        $this->resetValidation();
    }
}
