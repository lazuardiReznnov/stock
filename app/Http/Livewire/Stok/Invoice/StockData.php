<?php

namespace App\Http\Livewire\Stok\Invoice;

use App\Models\Tag;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Sparepart;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class StockData extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $invoiceId;
    public $search = '';
    public $tag_id = '';
    public $spareparts,
        $tags,
        $name,
        $sparepart_id,
        $qty,
        $price,
        $brand,
        $stockId;

    public function mount($invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->spareparts = Sparepart::all();
        $this->tags = Tag::all();
    }

    protected function rules()
    {
        return [
            'sparepart_id' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'brand' => 'required',
            'tag_id' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $stock = Stock::where(
            'invoice_stock_id',
            '=',
            $this->invoiceId
        )->latest();

        return view('livewire.stok.invoice.stock-data', [
            'stocks' => $stock
                ->with('sparepart')
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ]);
    }
    public function saveStock()
    {
        $validatedData = $this->validate();
        $validatedData['name'] = Str::random(10);
        $validatedData['invoice_stock_id'] = $this->invoiceId;

        $stock = Stock::create($validatedData);
        if ($this->tag_id) {
            $stock->tags()->sync($this->tag_id);
        }
        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editStock($stockId)
    {
        $stock = Stock::find($stockId);
        if ($stock) {
            $this->stockId = $stock->id;
            $this->invoiceId = $stock->invoice_stock_id;
            $this->sparepart_id = $stock->sparepart_id;
            $this->qty = $stock->qty;
            $this->price = $stock->price;
            $this->brand = $stock->brand;
            $this->tag_id = $stock->tags;
        }
    }

    public function updateStock()
    {
        $validatedData = $this->validate();
        $validatedData['name'] = Str::random(10);
        $validatedData['invoice_stock_id'] = $this->invoiceId;

        $stock = Stock::find($this->stockId);
        $stock->update($validatedData);
        if ($this->tag_id) {
            $stock->tags()->sync($this->tag_id);
        }

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteStock(int $stockId)
    {
        $this->stockId = $stockId;
    }

    public function destroyStock()
    {
        $stock = Stock::find($this->stockId);
        if ($stock->tag) {
            $stock->tag()->delete();
        }
        $stock->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->tag_id = '';
        $this->sparepart_id = '';
        $this->qty = '';
        $this->price = '';
        $this->brand = '';
        $this->resetValidation();
    }
}
