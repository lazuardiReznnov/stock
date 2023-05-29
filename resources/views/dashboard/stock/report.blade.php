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
                <x-card-title> Summary Cash</x-card-title>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>

                            <th scope="col">Invoice Number</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col" class="text-center">Summary</th>

                            <th scope="col">State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $gttl1=0;
                        ?>
                        @if($cashes->count()) @foreach($cashes as $cash)

                        <tr>
                            <th scope="row">
                                {{ ($cashes->currentpage()-1) * $cashes->perpage() + $loop->index + 1 }}
                            </th>
                            <td>
                                {{ \Carbon\Carbon::parse($cash->tgl)->format('d/m/Y') }}
                            </td>
                            <td>{{ $cash->name }}</td>
                            <td>{{ $cash->supplier->name }}</td>
                            <td class="text-end">
                                <?php $sum=0 ?>

                                @foreach($cash->stock as $stock)
                                <?php 
                                        $ttl = $stock->qty*$stock->price; $sum =
                                $sum+$ttl; ?> @endforeach @currency($sum)
                            </td>

                            <td>{{ $cash->state }}</td>

                            <!-- Modal Image -->
                        </tr>
                        <?php 
                        $gttl1 = $gttl1+$sum;
                        ?>
                        @endforeach
                        <tr class="fw-bold">
                            <td class="text-end" colspan="4">Grandtotal</td>
                            <td class="text-end">@currency($gttl1)</td>
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

    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Summary Debt</x-card-title>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>

                            <th scope="col">Invoice Number</th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col" class="text-center">Summary</th>

                            <th scope="col">State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $gttl2=0;
                        ?>
                        @if($debts->count()) @foreach($debts as $debt)

                        <tr>
                            <th scope="row">
                                {{ ($debts->currentpage()-1) * $debts->perpage() + $loop->index + 1 }}
                            </th>
                            <td>
                                {{ \Carbon\Carbon::parse($debt->tgl)->format('d/m/Y') }}
                            </td>
                            <td>{{ $debt->name }}</td>
                            <td>{{ $debt->supplier->name }}</td>
                            <td class="text-end">
                                <?php $sum=0 ?>

                                @foreach($debt->stock as $stock)
                                <?php 
                                        $ttl = $stock->qty*$stock->price; $sum =
                                $sum+$ttl; ?> @endforeach @currency($sum)
                            </td>

                            <td>{{ $debt->state }}</td>

                            <!-- Modal Image -->
                        </tr>
                        <?php 
                        $gttl2 = $gttl2+$sum;
                        ?>
                        @endforeach
                        <tr class="fw-bold">
                            <td class="text-end" colspan="4">Grandtotal</td>
                            <td class="text-end">@currency($gttl2)</td>
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
            <x-card class="p-2">
                <div class="row fw-bold">
                    <div class="col-md-5">Total</div>
                    <div class="col-md-6 text-end">
                        @currency($gttl1+$gttl2)
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</x-dashboard>
