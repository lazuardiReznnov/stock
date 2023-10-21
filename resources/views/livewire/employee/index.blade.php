<div>
    <div class="row">
        @include('livewire.employee.modal')
        <div class="col-md">
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
    <section class="section dashboard">
        <x-card>
            <x-card-header>
                <div class="row my-3 justify-content-between">
                    <div class="col-md-4">
                        <x-button-group>
                            <x-button-link
                                class="btn-primary"
                                href="/dashboard/employee"
                            >
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </x-button-link>
                            <x-button-link
                                class="btn-primary"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#employeeModal"
                            >
                                <i class="bi bi-plus-circle"></i> Employee
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
            </x-card-header>
            <x-card-body>
                <table class="table table-striped my-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Identity</th>
                            <th scope="col">Position</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($datas->count()) @foreach($datas as $data)
                        <tr>
                            <th scope="row">
                                {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                            </th>

                            <td width="300px">{{ $data->name }}</td>

                            <td width="300px">{{$data->identity}}</td>
                            <td width="300px">{{$data->position}}</td>
                            <td width="300px">
                                <a
                                    href="/dashboard/employee/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Employee"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <a
                                    class="badge bg-warning border-0"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateEmployeeModal"
                                    title="Edit Employee"
                                    wire:click="editEmployee({{ $data->id }})"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>
                                <a
                                    class="badge bg-danger border-0"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteEmployeeModal"
                                    title="Delete Employee"
                                    wire:click="deleteEmployee({{ $data->id }})"
                                >
                                    <i class="bi bi-x-lg"></i
                                ></a>
                            </td>
                            <!-- Modal Image -->
                        </tr>
                        @endforeach
                        <!-- Modal -->

                        <!-- End Modal Image -->
                        @else
                        <tr>
                            <td colspan="5" class="text-center">
                                Data Not Found
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-8">
                        {{ $datas->links() }}
                    </div>
                </div>
            </x-card-body>
        </x-card>
    </section>
</div>
