<div>
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
    <div class="row my-3">
        <div class="col">
            <div class="progress">
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: {{ $progress->progress }}%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >
                    {{ $progress->progress }}%
                </div>
            </div>
            <ul class="list-group my-3">
                @foreach($statelog as $sl)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        {{ $sl->description }}
                        <br />
                        <small
                            class="text-muted"
                            >{{ $sl->updated_at->diffForHumans() }}</small
                        >
                    </div>
                    <div>
                        <a
                            href="#"
                            wire:click="getState({{ $sl->id }})"
                            class="badge bg-warning"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Progress maintenance"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a
                            href="#"
                            wire:click="destroy({{ $sl->id }})"
                            class="badge bg-danger"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Progress maintenance"
                        >
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card p-3">
        @if($statusUpdate) @livewire('maintenance.progress-update') @else
        @livewire('maintenance.progress-create', ['maintenanceId'=>
        $progress->id]) @endif
    </div>
</div>
