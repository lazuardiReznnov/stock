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
    public $tag_id = [];
    public $spareparts, $tags, $name, $sparepart_id, $qty, $price, $brand;

    public function mount($invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->spareparts = Sparepart::all();
        $this->tags = Tag::all();
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
        dd($this->tag_id);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->tag_id = '';
        $this->sparepart_id = '';
        $this->qty = '';
        $this->price = '';
        $this->brand = '';
        $this->resetValidation();
    }
}
