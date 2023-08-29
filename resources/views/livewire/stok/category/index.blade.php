<div>
    <div class="row">
        @include('livewire.stok.category.modal')
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

    <div class="row my-2">
        <div class="col-md-12">
            <x-card>
                <div class="card-header">
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
                                    data-bs-target="#categoryModal"
                                >
                                    <i class="bi bi-plus-circle"></i>

                                    Add
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
                </div>
                <x-card-title> Category List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>

                            <th scope="col">description</th>
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

                            <td>{!! $data->description !!}</td>

                            <td>
                                <button
                                    href="#"
                                    class="badge bg-warning border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateCategoryModal"
                                    title="Edit Category"
                                    wire:click="editCategory({{ $data->id }})"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCategoryModal"
                                    title="Delete Category"
                                    wire:click="deleteCategory({{ $data->id }})"
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
