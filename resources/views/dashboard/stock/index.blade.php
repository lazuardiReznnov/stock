<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Stock" />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-4">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/invoiceStock"
                >
                    <i class="bi bi-plus-circle"></i> Stock-In
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        aria-current="page"
                        href="/dashboard/stock/supplier"
                        >Supplier</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/stock/category"
                        >Categories</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/stock/sparepart"
                        >Sparepart</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/stock/report"
                        >Report</a
                    >
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Stock List </x-card-title>
                <div class="accordion accordion-flush" id="sparepart">
                    @foreach($datas as $data)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $data->slug }}"
                                aria-expanded="false"
                                aria-controls="{{ $data->slug }}"
                            >
                                {{ $data->name }}
                            </button>
                        </h2>

                        <div
                            id="{{ $data->slug }}"
                            class="accordion-collapse collapse"
                            data-bs-parent="#sparepart"
                        >
                            <div class="accordion-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Name</th>
                                            <th scope="col">type</th>
                                            <th scope="col">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->sparepart->count())
                                        @foreach($data->sparepart as $sparepart)
                                        <tr>
                                            <td scope="row">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td scope="col">
                                                {{ $sparepart->name }}
                                            </td>
                                            <td scope="col">
                                                {{ $sparepart->type->name }}
                                            </td>
                                            <td scope="col">
                                                <?php 
                                                    $qty = $sparepart->stock->sum('qty')-$sparepart->maintenancePart->sum('qty')
                                                ?>
                                                {{ $qty }}
                                            </td>
                                        </tr>
                                        @endforeach @else
                                        <tr>
                                            <td colspan="4">Empty</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </div>
</x-dashboard>
