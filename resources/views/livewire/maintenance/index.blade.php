<div>
    <?php 
    $date_now = date("Y/m/d")

?>
    @include('livewire.maintenance.modal')
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
    <div class="row my-2 justify-content-between">
        <div class="col-md-4">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#maintenanceModal"
                >
                    <i class="bi bi-plus-circle"></i> Add Data
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <div class="search-bar">
                <input
                    type="month"
                    class="form-control"
                    name="search"
                    placeholder="Search"
                    title="Enter search keyword"
                    wire:model="search"
                />
            </div>
        </div>
    </div>

    <x-card>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Date</th>
                    <th scope="col">No. Reg</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Descrption</th>
                    <th scope="col">Estimate</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($datas->count()) @foreach($datas as $data)
                <tr>
                    <th scope="row">
                        {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                    </th>
                    <td width="90px">
                        {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                    </td>
                    <td width="50px">{{ $data->name }}</td>
                    <td width="100px">
                        {{ $data->unit->name }}
                    </td>

                    <td width="300px">{!! $data->description !!}</td>
                    <td>{{ $data->estimate }} Day</td>
                    <td>
                        <div class="progress">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: {{ $data->progress }}%"
                                aria-valuenow="25"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                {{ $data->progress }}%
                            </div>
                        </div>
                    </td>

                    <td>
                        <a
                            href="/dashboard/maintenance/{{ $data->slug }}"
                            class="badge bg-success"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Detail maintenance"
                            ><i class="bi bi-eye"></i
                        ></a>
                        <a
                            href="#"
                            class="badge bg-warning border-0"
                            data-bs-toggle="modal"
                            data-bs-target="#updateMaintenanceModal"
                            wire:click="editMaintenance({{ $data->id }})"
                            title="Edit maintenance"
                            ><i class="bi bi-pencil-square"></i
                        ></a>

                        <button
                            class="badge bg-danger border-0"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteMaintenanceModal"
                            title="Delete maintenance"
                            wire:click="deleteMaintenance({{ $data->id }})"
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
                    <td colspan="6" class="text-center">Data Not Found</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-8">
                {{ $datas->links() }}
            </div>
        </div>
    </x-card>
</div>
