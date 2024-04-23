<div>
    @include('livewire.transaction.track.track-modal')
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
                                    href="/dashboard/transaction/"
                                >
                                    <i class="bi bi-arrow-left-circle"></i> Back
                                </x-button-link>
                                <x-button-link
                                    class="btn-primary"
                                    href="#"
                                    data-bs-toggle="modal"
                                    data-bs-target="#trackModal"
                                >
                                    <i class="bi bi-plus-circle"></i> Add Track
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
                            <th scope="col">No Letter</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Region</th>
                            <th scope="col">Type</th>
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
                            <td>{{ $data->letter_number }}</td>
                            <td>{{ $data->unit->name }}</td>

                            <td>{{ $data->customer->name }}</td>

                            <td>{{ $data->region->name }}</td>
                            <td>{{ $data->type }}</td>
                            <!-- <td>{{ $data->address }}</td> -->

                            <td>
                                <a
                                    href="/dashboard/transaction/track/{{ $data->slug }}"
                                    class="badge bg-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail Unit"
                                    ><i class="bi bi-eye"></i
                                ></a>
                                <button
                                    class="badge bg-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateTrackModal"
                                    wire:click="editTrack({{ $data->id }})"
                                    title="Edit data"
                                    type="button"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button
                                    class="badge bg-danger border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteTrackModal"
                                    title="Delete Track"
                                    wire:click="deleteTrack({{ $data->id }})"
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

    @push('script2')

    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk="
        crossorigin="anonymous"
    ></script>
    @endpush
</div>
