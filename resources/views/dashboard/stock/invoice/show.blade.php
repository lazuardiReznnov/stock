<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/invoiceStock"
                name="Invoice"
            />
            <x-breadcrumb-item link="" name="{{ $data->name }}" />
        </x-breadcrumb>
    </x-pagetitle>

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

    <div class="row">
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
                    href="/dashboard/stock/invoiceStock/stock-in/{{ $data->slug }}"
                >
                    <i class="bi bi-plus-circle"></i> Add Item
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <form
                    class="search-form d-flex align-items-center"
                    method="GET"
                    action="/dashboard/stock/invoiceStock"
                >
                    <input
                        type="text"
                        name="search"
                        placeholder="Search"
                        title="Enter search keyword"
                    />
                    <button type="submit" title="Search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Item {{ $data->name }} </x-card-title>
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
                                <a
                                    href="/dashboard/stock/invoiceStock/stock-in/{{ $stock->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit Item Invoice"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <form
                                    action="/dashboard/stock/invoiceStock/stock-in/{{ $stock->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete stock"
                                        onclick="return confirm('are You sure ??')"
                                    >
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
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
</x-dashboard>
