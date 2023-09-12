<div>
    @include('livewire\stok\supplier\modal')
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
        <div class="col-md-12">
            <x-card>
                <x-card-header>
                    <div class="row">
                        <div class="col-md-6">
                            <x-button-group>
                                <x-button-link
                                    class="btn-primary"
                                    href="/dashboard/stock"
                                >
                                    Back
                                </x-button-link>
                                <x-button-link
                                    class="btn-primary"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#supplierModal"
                                >
                                    Add
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
                </x-card-header>
                <x-card-title> Supplier List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{!! $data->address !!}</td>

                            <td>
                                <a
                                    href="/dashboard/stock/supplier/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Supplier"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <a
                                    href="/dashboard/stock/supplier/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateSupplierModal"
                                    title="Edit Supplier"
                                    wire:click="editSupplier({{ $data->id }})"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteSupplierModal"
                                    title="Delete Supplier"
                                    wire:click="deleteSupplier({{ $data->id }})"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach @else
                        <tr>
                            <td colspan="4" class="text-center">
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
</div>
