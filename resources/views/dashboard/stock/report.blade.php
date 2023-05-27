<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Report" />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-4">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <form
                    class="search-form d-flex align-items-center"
                    method="GET"
                    action="/dashboard/stock/report"
                >
                    <input
                        type="month"
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
    <?php 
        $date_now = date('M Y')
    
    ?>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title>
                    Report payment Stock {{ $date_now }}</x-card-title
                >
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
                        <?php 
                            $gttl=0;
                        ?>
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
                        <?php 
                        $gttl = $gttl+$sum;
                        ?>
                        @endforeach
                        <tr class="fw-bold">
                            <td class="text-end" colspan="4">Grandtotal</td>
                            <td class="text-end">@currency($gttl)</td>
                            <td colspan="3"></td>
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
