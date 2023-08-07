<div>
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
                            href=""
                            class="badge bg-warning"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Progress maintenance"
                        >
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="" method="post" class="d-inline">
                            @method('delete') @csrf
                            <input
                                type="hidden"
                                name="id"
                                value="{{ $sl->id }}"
                            />
                            <button
                                class="badge bg-danger border-0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Delete maintenance"
                                onclick="return confirm('are You sure ??')"
                            >
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card p-3">
        <livewire:maintenance.progress.create />
    </div>
</div>
