<div>
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
                    <div class="row my-4 justify-content-between">
                        <div class="col-md-4">
                            <x-button-group>
                                <x-button-link
                                    class="btn-primary"
                                    href="/dashboard/transaction/rate"
                                >
                                    <i class="bi bi-arrow-left-circle"></i> Back
                                </x-button-link>
                                <x-button-link
                                    class="btn-primary"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#customerModal"
                                >
                                    <i class="bi bi-plus-circle"></i> Add Rates
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
                <x-card-title> Customer List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Region</th>
                            <th scope="col">Name</th>
                            <th scope="col">type</th>
                            <th scope="col">fare</th>
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
                            <td>{{ $data->region->name }}</td>

                            <td>{{ $data->name }}</td>

                            <td>{{ $data->type }}</td>
                            <td>{{ $data->fare }}</td>
                            <!-- <td>{{ $data->address }}</td> -->

                            <td>
                                <a
                                    href="/dashboard/transaction/rate/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Unit"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <button
                                    class="badge bg-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateRateModal"
                                    wire:click="editrate({{ $data->id }})"
                                    title="Edit data"
                                    type="button"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteRateModal"
                                    title="Delete rate"
                                    wire:click="deleterate({{ $data->id }})"
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
