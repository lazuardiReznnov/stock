<div>
    @include('livewire.transaction.customer-modal')
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
    <div class="row my-4 justify-content-center">
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
    <div class="row my-2">
        <div class="col-md-4">
            <x-button-group>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/transaction"
                >
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#customerModal"
                >
                    <i class="bi bi-plus-circle"></i> Add Customer
                </x-button-link>
            </x-button-group>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Customer List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pic</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <!-- <th scope="col">address</th> -->
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
                                @if($data->image)
                                <img
                                    width="50"
                                    class="img-fluid mb-2"
                                    alt=""
                                    src="{{ asset('storage/'. $data->image->pic) }}"
                                />

                                @else
                                <img
                                    width="50"
                                    class="img-preview img-fluid mb-2"
                                    alt=""
                                    src="http://source.unsplash.com/50x50?smartphones"
                                />
                                @endif
                            </td>
                            <td>{{ $data->name }}</td>

                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->email }}</td>
                            <!-- <td>{{ $data->address }}</td> -->

                            <td>
                                <button
                                    class="badge bg-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateCustomerModal"
                                    wire:click="editCustomer({{ $data->id }})"
                                    title="Edit data"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCustomerModal"
                                    title="Delete Customer"
                                    wire:click="deleteCustomer({{ $data->id }})"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>
                            <!-- Modal Image -->
                        </tr>
                        @endforeach
                        <!-- Modal -->

                        <!-- End Modal Image -->
                        @else
                        <tr>
                            <td colspan="6" class="text-center">
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
