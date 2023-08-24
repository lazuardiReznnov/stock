<div>
    @include('livewire\stok\sparepart\modal')
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

    <div class="row my-4">
        <div class="col-md-6">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard/stock">
                    <i class="bi bi-arrow-left-square"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#sparepartStockModal"
                >
                    <i class="bi bi-file-earmark-plus"></i> Add
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/sparepart/create-excl"
                >
                    <i class="bi bi-file-earmark-spreadsheet"></i> Upload Excel
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="Search"
                    title="Enter search keyword"
                    wire:model="search"
                />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-title> Sparepart List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Type</th>
                            <th scope="col">Code-Part</th>
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
                            <td>{{ $data->category->name }}</td>
                            <td>{{ $data->type->name }}</td>
                            <td>{{$data->code}}</td>

                            <td>
                                <button
                                    href="#"
                                    class="badge bg-warning border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateSparepartStockModal"
                                    title="Edit Sparepart Stock"
                                    wire:click="editSparepartStock({{ $data->id }})"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteSparepartStockModal"
                                    title="Delete Sparepart Stock"
                                    wire:click="deleteSparepartStock({{ $data->id }})"
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