<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="rateModal"
    tabindex="-1"
    aria-labelledby="rateModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="rateModalLabel">
                    Create Rate Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveRate">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="name"
                            name="name"
                            wire:model="name"
                        />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3" wire:ignore>
                        <select
                            id="unit"
                            class="form-select @error('region_id') is-invalid @enderror"
                            name="region_id"
                            wire:model="region_id"
                        >
                            <option>Choose region ...</option>
                            @if($regions !== null) @foreach($regions as $region)

                            <option value="{{ $region->id }}">
                                {{ $region->name }}
                            </option>

                            @endforeach @endif
                        </select>

                        @error('region_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            id="type"
                            type="text"
                            class="form-control @error('type') is-invalid @enderror"
                            placeholder="type"
                            name="type"
                            wire:model="type"
                        />
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="fare"
                            type="fare"
                            class="form-control @error('fare') is-invalid @enderror"
                            placeholder="fare"
                            name="fare"
                            wire:model="fare"
                        />
                        @error('fare')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        wire:click="closeModal"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                    <div wire:loading>save...</div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endinput -->

<!-- modal update -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateRateModal"
    tabindex="-1"
    aria-labelledby="updateRateModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateRateModalLabel">
                    Update Rate Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateRate">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="name"
                            name="name"
                            wire:model="name"
                        />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <select
                            id="region"
                            class="form-select"
                            name="region_id"
                            wire:model="region_id"
                        >
                            <option selected>Choose Regions ...</option>
                            @if($regions !== null) @foreach($regions as $region)

                            <option value="{{ $region->id }}" selected>
                                {{ $region->name }}
                            </option>
                            @endforeach @endif
                        </select>

                        @error('region_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="type"
                            type="text"
                            class="form-control @error('type') is-invalid @enderror"
                            placeholder="type"
                            name="type"
                            wire:model="type"
                        />
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="fare"
                            type="fare"
                            class="form-control @error('fare') is-invalid @enderror"
                            placeholder="fare"
                            name="fare"
                            wire:model="fare"
                        />
                        @error('fare')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        wire:click="closeModal"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update changes
                    </button>
                    <div wire:loading>Update...</div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Delete -->
<div
    wire:ignore.self
    class="modal fade"
    id="deleteRateModal"
    tabindex="-1"
    aria-labelledby="deleteRateModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteRateModalLabel">
                    Delete Rate Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyRate">
                <div class="modal-body">
                    <h4>Are You Sure.??</h4>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        wire:click="closeModal"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Delete changes
                    </button>
                    <div wire:loading>Delete...</div>
                </div>
            </form>
        </div>
    </div>
</div>
