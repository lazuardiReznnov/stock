<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/transaction"
                name="transaction"
            />
            <x-breadcrumb-item link="" name="Customer" />
        </x-breadcrumb>
    </x-pagetitle>

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

    <div class="row my-4 justify-content-center">
        <div class="col-md-6">
            <div class="search-bar">
                <form
                    class="search-form d-flex align-items-center"
                    method="GET"
                    action="/dashboard/transaction/customer"
                >
                    <input
                        type="text"
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
                    href="/dashboard/transaction/customer/create"
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
                            <th scope="col">address</th>
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
                            <td>{{ $data->address }}</td>

                            <td>
                                <a
                                    href="/dashboard/transaction/customer/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit data"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <form
                                    action="/dashboard/transaction/customer/{{ $data->slug }}"
                                    method="post"
                                    class="d-inline"
                                >
                                    @method('delete') @csrf
                                    <button
                                        class="badge bg-danger border-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete Data"
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
</x-dashboard>
