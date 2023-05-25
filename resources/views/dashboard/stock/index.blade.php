<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Category" />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-6">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard">
                    Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/invoiceStock"
                >
                    Add
                </x-button-link>
            </x-button-group>
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
                                                Name
                                                {{ $sparepart->name }}
                                            </td>
                                            <td scope="col">
                                                Type
                                                {{ $sparepart->type->name }}
                                            </td>
                                            <td scope="col">0</td>
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
