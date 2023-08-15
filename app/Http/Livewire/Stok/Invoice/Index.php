<?php

namespace App\Http\Livewire\Stok\Invoice;

use Livewire\Component;
use App\Models\InvoiceStock;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $suppliers;
    public $name, $supplier_id, $tgl, $method, $pic;

    public function mount()
    {
        $this->suppliers = Supplier::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'supplier_id' => 'required',
            'name' => 'required|unique:invoice_stocks',
            'tgl' => 'required',
            'method' => 'required',
            'pic' => 'image|file|max:2048',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveInvoiceStock()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        if ($this->method == 'Cash') {
            $validatedData['state'] = 'Paid';
        } elseif ($this->method == 'Debt') {
            $validatedData['state'] = 'unpaid';
        }

        $invoiceStock = InvoiceStock::create($validatedData);

        if ($this->pic) {
            $this->pic->store('Customer-Pic');
            $invoiceStock->image()->create(['pic' => $this->pic]);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $datey = date('Y');
        $datem = date('m');
        $invoice = InvoiceStock::latest();

        if ($this->search) {
            $invoice->where('tgl', 'like', '%' . $this->search . '%');
        } else {
            $invoice
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey);
        }

        return view('livewire.stok.invoice.index', [
            'datas' => $invoice
                ->with('Supplier', 'stock')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->supplier_id = '';
        $this->method = '';
        $this->tgl = '';
        $this->pic = '';
    }
}
