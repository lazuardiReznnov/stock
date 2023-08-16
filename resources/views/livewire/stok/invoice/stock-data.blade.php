<div>
    @include('livewire\stok\invoice\stock-modal')

    <div class="row">
        <div class="col-md-8">
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

    <div class="row my-3">
        <div class="col-md-6">
            <x-button-group>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/invoiceStock"
                >
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#stockModal"
                >
                    <i class="bi bi-plus-circle"></i> Add Item
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <input
                    type="text"
                    name="search"
                    placeholder="Search"
                    title="Enter search keyword"
                    wire:model="search"
                    class="form-control"
                />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Item </x-card-title>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sparepart Name</th>

                            <th scope="col">Brand</th>
                            <th scope="col">Qty</th>
                            <th scope="col" class="text-end">Price</th>
                            <th scope="col" class="text-end">summary</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $gttl1=0;
                        ?>
                        @if($stocks->count()) @foreach($stocks as $stock)

                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}
                            </th>
                            <td>{{ $stock->sparepart->name }}</td>
                            <td>{{ $stock->brand }}</td>
                            <td>{{ $stock->qty }}</td>
                            <td class="text-end">@currency($stock->price)</td>
                            <td class="text-end">
                                <?php $sum=0 ;
                                    $sum = $stock->price*$stock->qty; ?>
                                @currency($sum)
                            </td>

                            <td>
                                <button
                                    class="badge bg-warning border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateStockModal"
                                    title="Edit Stock"
                                    wire:click="editStock({{ $stock->id }})"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteStockModal"
                                    title="Delete Invoice Stock"
                                    wire:click="deleteStock({{ $stock->id }})"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>

                            <!-- Modal Image -->
                        </tr>
                        <?php 
                        $gttl1 = $gttl1+$sum;
                        ?>
                        @endforeach
                        <tr class="fw-bold">
                            <td class="" colspan="5">Grandtotal</td>
                            <td class="text-end">@currency($gttl1)</td>
                            <td colspan="4"></td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="8" class="text-center">
                                Data Not Found
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</div>
