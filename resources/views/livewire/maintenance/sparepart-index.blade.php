<div>
    @include('livewire.maintenance.sparepart-modal')
    <x-card-title> Replacing Sparepart </x-card-title>
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>

                <th scope="col">Sparepart Name</th>
                <th scope="col">code</th>
                <th scope="col">Qty</th>
                <th scope="col">price</th>
                <th scope="col">sum</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $sumttl=0; ?>
            @if($data->count()) @foreach($data as $part)
            <tr>
                <th scope="row">
                    {{ $loop->iteration }}
                </th>
                <td>
                    {{ $part->sparepart->name }}
                </td>
                <td>
                    {{ $part->description}}
                </td>
                <td>
                    {{ $part->qty }}
                </td>
                <td>@currency($part->price)</td>
                <td><?php $sum = $part->price*$part->qty ?> @currency($sum)</td>

                <td>
                    <a
                        href="#"
                        class="badge bg-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#updateMaintenanceSparepartModal"
                        wire:click="editMaintenanceSparepart({{ $part->id }})"
                        ><i class="bi bi-pencil-square"></i
                    ></a>

                    <form
                        action="/dashboard/maintenance/sparepart/{{ $part->id }}"
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
            <?php $sumttl = $sumttl+$sum ?>
            @endforeach
            <tr class="fw-bold">
                <td colspan="5">Grand Total</td>
                <td>@currency($sumttl)</td>
                <td></td>
            </tr>
            @else
            <tr>
                <td colspan="7" class="text-center">Data Not Found</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
