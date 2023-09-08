<?php

namespace App\Http\Livewire\Unit;

use App\Models\Vrc;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class VrcUpdate extends Component
{
    use WithFileUploads;
    public $unitId,
        $pic,
        $oldPic,
        $regnumber,
        $owner,
        $address,
        $region,
        $tax,
        $expire,
        $vrcId,
        $image;

    protected $rules = [
        'regnumber' => 'required|min:6',
        'owner' => 'required',
        'address' => 'required',
        'region' => 'required',
        'tax' => 'required',
        'expire' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editVrc($unitId)
    {
        $vrc = Vrc::where('unit_id', $unitId)->first();
        if ($vrc) {
            $this->vrcId = $vrc->id;
            $this->regnumber = $vrc->regnumber;
            $this->owner = $vrc->owner;
            $this->address = $vrc->address;
            $this->region = $vrc->region;
            $this->tax = $vrc->tax;
            $this->expire = $vrc->expire;
            if ($vrc->image) {
                $this->oldPic = $vrc->image->pic;
            }
        } else {
            return redirect()->to('/unit/show/' . $vrc->unit->slug);
        }
    }

    public function updateVrc()
    {
        $vrc = Vrc::find($this->vrcId);

        if ($this->pic) {
            $data = $this->validate(['pic' => 'image|file|max:2048']);
            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $vrc->image()->delete();
            }
            $data['pic'] = $this->pic->store('vrc-Pic');
            $vrc->image()->create($data);
        }
        $validatedData = $this->validate();

        $vrc->update($validatedData);
        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function showImage($unitId)
    {
        $vrc = Vrc::where('unit_id', $unitId)->first();

        if ($vrc->image) {
            $this->image = $vrc->image->pic;
        }
    }

    public function render()
    {
        return view('livewire.unit.vrc-update', [
            'data' => Vrc::where('unit_id', $this->unitId)
                ->with('image')
                ->first(),
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
        $this->tax = '';
        $this->expire = '';

        $this->resetValidation();
    }
}
