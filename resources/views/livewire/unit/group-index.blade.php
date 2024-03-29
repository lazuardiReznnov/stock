<div>
    @include('livewire.unit.group-modal')
    <!-- Flash -->
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

    <!-- Search -->

    <!-- Link -->

    <!-- Table -->
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <x-card-header>
                    <div class="row my-2">
                        <div class="col-md-6">
                            <x-button-group>
                                <x-button-link
                                    class="btn-primary"
                                    href="/dashboard/unit"
                                >
                                    <i class="bi bi-arrow-left-circle"></i> Back
                                </x-button-link>
                                <x-button-link
                                    class="btn-primary"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#groupModal"
                                >
                                    <i class="bi bi-plus-circle"></i> Unit Group
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

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Descrtiption</th>
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
                                <a
                                    href="/dashboard/unit/group/{{ $data->slug }}/edit"
                                    class="badge bg-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateGroupModal"
                                    title="Edit Group"
                                    wire:click="editGroup({{ $data->id }})"
                                    ><i class="bi bi-pencil-square"></i
                                ></a>

                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteGroupModal"
                                    title="Delete Group"
                                    wire:click="deleteGroup({{ $data->id }})"
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
