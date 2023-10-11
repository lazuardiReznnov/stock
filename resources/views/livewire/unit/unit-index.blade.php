<div>
    <!-- flash message -->
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
                    <div class="row my-1 justify-content-between">
                        <div class="col-md-6">
                            <x-button-group>
                                <x-button-link
                                    class="btn-primary"
                                    href="/dashboard"
                                >
                                    <i class="bi bi-arrow-left-circle"></i> Back
                                </x-button-link>
                                <x-button-link
                                    class="btn-primary"
                                    href="/dashboard/unit/create"
                                >
                                    <i class="bi bi-plus-circle"></i> Add Unit
                                </x-button-link>
                            </x-button-group>
                        </div>

                        <div class="col-md-6 ms">
                            <div class="search-bar ms-auto">
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search"
                                    title="Enter search keyword"
                                    wire:model="search"
                                />
                            </div>
                        </div>
                    </div>
                </x-card-header>
                <x-card-title> Unit List </x-card-title>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">No. Reg</th>
                            <th scope="col">Merk/Type</th>

                            <th scope="col">Group</th>
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
                            <td>
                                {{ $data->type->brand->name }}
                                {{ $data->type->name }}
                            </td>

                            <td>{{ $data->group->name }}</td>

                            <td>
                                <a
                                    href="/dashboard/unit/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Unit"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <a
                                    href="/dashboard/unit/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit Unit"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <form
                                    action="/dashboard/unit/{{ $data->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete Unit"
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
