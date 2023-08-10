<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="maintenanceModal"
    tabindex="-1"
    aria-labelledby="maintenanceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="maintenanceModalLabel">
                    Create Maintenance Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveMaintenance">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="unit"
                            class="form-select @error('unit_id') is-invalid @enderror"
                            name="unit_id"
                            wire:model="unit_id"
                        >
                            <option>Choose unit ...</option>
                            @foreach($units as $unit)

                            <option value="{{ $unit->id }}">
                                {{ $unit->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('unit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="date"
                            class="form-control @error('tgl') is-invalid @enderror"
                            placeholder="Date"
                            name="tgl"
                            wire:model="tgl"
                        />
                        @error('tgl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="descriptions"
                            name="description"
                            rows="3"
                            wire:model="description"
                        ></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <textarea
                            class="form-control @error('instruction') is-invalid @enderror"
                            id="instruction"
                            name="instruction"
                            rows="3"
                            wire:model="instruction"
                        ></textarea>
                        @error('instruction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="mechanic"
                            type="text"
                            class="form-control @error('mechanic') is-invalid @enderror"
                            placeholder="Mechanic"
                            name="mechanic"
                            wire:model="mechanic"
                        />
                        @error('mechanic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="estimate"
                            type="text"
                            class="form-control @error('estimate') is-invalid @enderror"
                            placeholder="estimate Per Day"
                            name="estimate"
                            wire:model="estimate"
                        />
                        @error('estimate')
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
    id="updateMaintenanceModal"
    tabindex="-1"
    aria-labelledby="updateMaintenanceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateMaintenanceModalLabel">
                    Update Maintenance Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateMaintenance">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="unit"
                            class="form-select @error('unit_id') is-invalid @enderror"
                            name="unit_id"
                            wire:model="unit_id"
                        >
                            <option>Choose unit ...</option>
                            @foreach($units as $unit)

                            <option value="{{ $unit->id }}">
                                {{ $unit->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('unit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="date"
                            class="form-control @error('tgl') is-invalid @enderror"
                            placeholder="Date"
                            name="tgl"
                            wire:model="tgl"
                        />
                        @error('tgl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            id="descriptions"
                            name="description"
                            rows="3"
                            wire:model="description"
                        ></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <textarea
                            class="form-control @error('instruction') is-invalid @enderror"
                            id="instruction"
                            name="instruction"
                            rows="3"
                            wire:model="instruction"
                        ></textarea>
                        @error('instruction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="mechanic"
                            type="text"
                            class="form-control @error('mechanic') is-invalid @enderror"
                            placeholder="Mechanic"
                            name="mechanic"
                            wire:model="mechanic"
                        />
                        @error('mechanic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="estimate"
                            type="text"
                            class="form-control @error('estimate') is-invalid @enderror"
                            placeholder="estimate Per Day"
                            name="estimate"
                            wire:model="estimate"
                        />
                        @error('estimate')
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
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Delete -->
<div
    wire:ignore.self
    class="modal fade"
    id="deleteMaintenanceModal"
    tabindex="-1"
    aria-labelledby="deleteMaintenanceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteMaintenanceModalLabel">
                    Delete Maintenance Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyMaintenance">
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
                </div>
            </form>
        </div>
    </div>
</div>
