<div>
    <section class="section dashboard">
        @include('livewire\stok\invoice\modal')
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('success'))

                <!-- pesan -->

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >
                    {{ session("success") }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="close"
                    ></button>
                </div>

                <!-- endpesan -->

                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6 col-md">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Cost <span>| This Month</span>
                        </h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                            >
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>Debt : @currency($ttlmd)</h6>
                                <h6>Cash : @currency($ttlmc)</h6>
                                <span class="text-success small pt-1 fw-bold"
                                    >@currency($ttlmd+$ttlmc)</span
                                >
                                <span class="text-muted small pt-2 ps-1"
                                    >Total Cost This Month</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <x-button-group>
                    <x-button-link class="btn-primary" href="/dashboard/stock">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </x-button-link>
                    <x-button-link
                        class="btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#invoiceStockModal"
                    >
                        <i class="bi bi-plus-circle"></i> Add Invoice
                    </x-button-link>
                </x-button-group>
            </div>
            <div class="col-md-6">
                <div class="search-bar">
                    <input
                        type="month"
                        name="search"
                        placeholder="Search"
                        title="Enter search keyword"
                        class="form-control"
                        wire:model="search"
                    />
                </div>
            </div>
        </div>
        <?php 
        $date_now = date("Y/m/d")
    
    ?>
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    <x-card-title>
                        Invoice List
                        {{ \Carbon\Carbon::parse($date_now)->format('d M Y') }}
                    </x-card-title>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>

                                <th scope="col">Invoice Number</th>
                                <th scope="col">Supplier Name</th>
                                <th scope="col" class="text-center">Summary</th>
                                <th scope="col">Method</th>
                                <th scope="col">State</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($datas->count()) @foreach($datas as $data)
                            <tr>
                                <th scope="row">
                                    {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                                </th>
                                <td>
                                    {{ \Carbon\Carbon::parse($data->tgl)->format('d/m/Y') }}
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->supplier->name }}</td>
                                <td class="text-end">
                                    <?php $sum=0 ?>

                                    @foreach($data->stock as $stock)
                                    <?php 
                                        $ttl = $stock->qty*$stock->price; $sum =
                                    $sum+$ttl; ?> @endforeach @currency($sum)
                                </td>
                                <td>{{ $data->method }}</td>
                                <td>{{ $data->state }}</td>
                                <td>
                                    <a
                                        href="/dashboard/stock/invoiceStock/{{ $data->slug }}"
                                        class="badge bg-success"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Detail Invoice"
                                        ><i class="bi bi-eye"></i
                                    ></a>
                                    <button
                                        href="#"
                                        class="badge bg-warning border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateInvoiceStockModal"
                                        title="Edit Invoice Stock"
                                        wire:click="editInvoiceStock({{ $data->id }})"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteInvoiceStockModal"
                                        title="Delete Invoice Stock"
                                        wire:click="deleteInvoiceStock({{ $data->id }})"
                                    >
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </td>
                                <!-- Modal Image -->
                            </tr>
                            <?php 
                       
                        ?>
                            @endforeach @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    Data Not Found
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-8">
                            {{ $datas->onEachside(2)->links() }}
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </section>
</div>
