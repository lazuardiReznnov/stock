<?php

namespace App\Http\Livewire\Stok\Supplier;

use Livewire\Component;
use App\Models\InvoiceStock;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\support\Facades\Storage;

class Show extends Component
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

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount($supplierId)
    {
        $this->supplier_id = $supplierId;
    }

    public function saveSupplierInvoice()
    {
        $this->rules['name'] = 'required|unique:invoice_stocks';

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);
        $validatedData['supplier_id'] = $this->supplier_id;

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

    protected $rules = [
        'name' => 'required',
        'tgl' => 'required',
        'method' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
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
            $invoice
                ->where('tgl', 'like', '%' . $this->search . '%')
                ->where(['supplier_id' => $this->supplier_id]);
            $costMonthDebt = InvoiceStock::with('stock')
                ->where(['supplier_id' => $this->supplier_id])
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
                ->whereYear('tgl', '=', $datey)
                ->where(['supplier_id' => $this->supplier_id]);
            $costMonthDebt = InvoiceStock::with('stock')
                ->where(['supplier_id' => $this->supplier_id])
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
                ->where(['supplier_id' => $this->supplier_id])
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

        return view('livewire.stok.supplier.show', [
            'datas' => $invoice
                ->with('Supplier', 'stock', 'image')
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
        $this->method = '';
        $this->tgl = '';
        $this->pic = '';
        $this->resetValidation();
    }
}
