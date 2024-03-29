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
    public $name,
        $supplier_id,
        $tgl,
        $method,
        $pic,
        $invoiceStockId,
        $oldPic,
        $image;

    public function mount()
    {
        $this->suppliers = Supplier::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $rules = [
        'supplier_id' => 'required',
        'name' => 'required',
        'tgl' => 'required',
        'method' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveInvoiceStock()
    {
        $this->rules['name'] = 'required|unique:invoice_stocks';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        if ($this->method == 'Cash') {
            $validatedData['state'] = 'Paid';
        } elseif ($this->method == 'Debt') {
            $validatedData['state'] = 'unpaid';
        }

        $invoiceStock = InvoiceStock::create($validatedData);

        if ($this->pic) {
            $data = $this->validate(['pic' => 'image|file|max:2048']);
            $data['pic'] = $this->pic->store('Invoice-Stock-Pic');
            $invoiceStock->image()->create($data);
        }

        session()->flash('success', 'Data Has Been Added');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function editInvoiceStock($invoiceStockId)
    {
        $invoiceStock = InvoiceStock::find($invoiceStockId);
        if ($invoiceStock) {
            $this->supplier_id = $invoiceStock->supplier_id;
            $this->name = $invoiceStock->name;
            $this->tgl = $invoiceStock->tgl;
            $this->method = $invoiceStock->method;
            if ($invoiceStock->image) {
                $this->oldPic = $invoiceStock->image->pic;
            }
            $this->invoiceStockId = $invoiceStockId;
        } else {
            return redirect()->to('/stock/invoiceStock');
        }
    }

    public function updateInvoiceStock()
    {
        $invoiceStock = InvoiceStock::find($this->invoiceStockId);
        if ($invoiceStock->name != $this->name) {
            $this->rules['name'] = 'required|unique:invoice_stocks';
        }

        $validatedData['slug'] = Str::slug($this->name);
        $validatedData = $this->validate();

        if ($this->method == 'Cash') {
            $validatedData['state'] = 'Paid';
        } elseif ($this->method == 'Debt') {
            $validatedData['state'] = 'unpaid';
        }

        if ($this->pic) {
            $data = $this->validate(['pic' => 'image|file|max:2048']);

            if ($this->oldPic) {
                storage::delete($this->oldPic);
                $invoiceStock->image()->delete();
            }
            $data['pic'] = $this->pic->store('Invoice-Stock-Pic');
            $invoiceStock->image()->create($data);
        }

        $invoiceStock->update($validatedData);

        session()->flash('success', 'Data Has Been Updated');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteInvoiceStock(int $invoiceStockId)
    {
        $this->invoiceStockId = $invoiceStockId;
    }

    public function destroyInvoiceStock()
    {
        $invoiceStock = InvoiceStock::find($this->invoiceStockId);
        if ($invoiceStock->image) {
            storage::delete($invoiceStock->image->pic);
            $invoiceStock->image->delete();
        }
        $invoiceStock->delete();
        session()->flash('success', 'Data Has Been Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function showImage($id)
    {
        $invoiceStock = InvoiceStock::where('id', $id)->first();

        if ($invoiceStock->image) {
            $this->image = $invoiceStock->image->pic;
        }
    }

    public function render()
    {
        $datey = date('Y');
        $datem = date('m');
        $invoice = InvoiceStock::latest();

        if ($this->search) {
            $invoice->where('tgl', 'like', '%' . $this->search . '%');
            $costMonthDebt = InvoiceStock::with('stock')
                ->where('tgl', 'like', '%' . $this->search . '%')
                ->where(['method' => 'Debt'])

                ->get();
            $ttlmd = 0;
            foreach ($costMonthDebt as $cm) {
                foreach ($cm->stock as $cms) {
                    $jml = $cms->qty * $cms->price;
                    $ttlmd = $ttlmd + $jml;
                }
            }

            $costMonthCash = InvoiceStock::with('stock')

                ->where(['method' => 'Cash'])
                ->where('tgl', 'like', '%' . $this->search . '%')
                ->get();
            $ttlmc = 0;
            foreach ($costMonthCash as $cmc) {
                foreach ($cmc->stock as $cmc) {
                    $jml2 = $cmc->qty * $cmc->price;
                    $ttlmc = $ttlmc + $jml2;
                }
            }
        } else {
            $invoice
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey);

            $costMonthDebt = InvoiceStock::with('stock')

                ->where(['method' => 'Debt'])
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey)
                ->get();
            $ttlmd = 0;
            foreach ($costMonthDebt as $cm) {
                foreach ($cm->stock as $cms) {
                    $jml = $cms->qty * $cms->price;
                    $ttlmd = $ttlmd + $jml;
                }
            }

            $costMonthCash = InvoiceStock::with('stock')

                ->where(['method' => 'Cash'])
                ->whereMonth('tgl', '=', $datem)
                ->whereYear('tgl', '=', $datey)
                ->get();
            $ttlmc = 0;
            foreach ($costMonthCash as $cmc) {
                foreach ($cmc->stock as $cmc) {
                    $jml2 = $cmc->qty * $cmc->price;
                    $ttlmc = $ttlmc + $jml2;
                }
            }
        }

        return view('livewire.stok.invoice.index', [
            'datas' => $invoice
                ->with('Supplier', 'stock')
                ->paginate(10)
                ->withQueryString(),
            'ttlmd' => $ttlmd,
            'ttlmc' => $ttlmc,
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
        $this->resetValidation();
    }
}
