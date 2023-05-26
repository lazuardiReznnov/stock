<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Invoice" />
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
                    Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/invoiceStock/stock-in/{{ $data->slug }}"
                >
                    Add
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
                            <th scope="col">categories</th>
                            <th scope="col">type</th>
                            <th scope="col">qty</th>
                            <th scope="col">price</th>
                            <th scope="col">sum</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($stocks->count()) @foreach($stocks as $stock)
                        <tr>
                            <?php
                                $jml = 0;
                            ?>
                            <th scope="row">
                                {{ ($stocks->currentpage()-1) * $stocks->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $stock->sparepart->name }}</td>
                            <td>{{ $stock->sparepart->category->name }}</td>
                            <td>{{ $stock->sparepart->type->name }}</td>
                            <td>{{ $stock->qty }}</td>
                            <td>@currency($stock->price)</td>
                            <td>
                                <?php
                                    $jml = $stock->qty*$stock->price; ?>
                                @currency($jml)
                            </td>

                            <td>
                                <a
                                    href="/dashboard/stock/invoiceStock/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Invoice"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <a
                                    href="/dashboard/stock/invoiceStock/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit stock"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <form
                                    action="/dashboard/stock/invoiceStock/{{ $data->slug }}"
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
                        @endforeach
                        <!-- Modal -->

                        <!-- End Modal Image -->
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
