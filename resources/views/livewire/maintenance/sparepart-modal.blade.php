<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="maintenanceSparepartModal"
    tabindex="-1"
    aria-labelledby="maintenanceSparepartModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="maintenanceSparepartModalLabel"
                >
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
            <form wire:submit.prevent="saveMaintenanceSparepart">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="sparepart"
                            class="form-select @error('sparepart_id') is-invalid @enderror"
                            name="sparepart_id"
                            wire:model="sparepart_id"
                        >
                            <option>Choose Sparepart ...</option>
                            @foreach($stocks as $stock)

                            <option value="{{ $stock->id }}">
                                {{ $stock->sparepart->type->brand->name }}
                                {{ $stock->sparepart->type->name }} -
                                {{ $stock->sparepart->name }}-
                                @currency($stock->price)
                            </option>

                            @endforeach
                        </select>

                        @error('sparepart_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            id="qty"
                            type="text"
                            class="form-control @error('qty') is-invalid @enderror"
                            placeholder="qty"
                            name="qty"
                            value="{{ old('qty') }}"
                            wire:model="qty"
                        />
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            id="description"
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="description"
                            name="description"
                            value="{{ old('description') }}"
                            wire:model="description"
                        />
                        @error('description')
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
                    <div wire:loading>Processing save...</div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endinput -->

<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateMaintenanceSparepartModal"
    tabindex="-1"
    aria-labelledby="updateMaintenanceSparepartModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="updateMaintenanceSparepartModalLabel"
                >
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
            <form wire:submit.prevent="updateMaintenanceSparepart">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="sparepart"
                            class="form-select @error('sparepart_id') is-invalid @enderror"
                            name="sparepart_id"
                            wire:model="sparepart_id"
                        >
                            <option>Choose Sparepart ...</option>
                            @foreach($stocks as $stock)

                            <option value="{{ $stock->sparepart->id }}">
                                {{ $stock->sparepart->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('sparepart_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            id="qty"
                            type="text"
                            class="form-control @error('qty') is-invalid @enderror"
                            placeholder="qty"
                            name="qty"
                            value="{{ old('qty') }}"
                            wire:model="qty"
                        />
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            id="description"
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="description"
                            name="description"
                            value="{{ old('description') }}"
                            wire:model="description"
                        />
                        @error('description')
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
                    <div wire:loading>Processing Update...</div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endinput -->

<!-- delete Modal -->
<div
    wire:ignore.self
    class="modal fade"
    id="deleteMaintenanceSparepartModal"
    tabindex="-1"
    aria-labelledby="deleteMaintenanceSparepartModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="deleteMaintenanceSparepartModalLabel"
                >
                    Delete Sparepart Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyMaintenanceSparepart">
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
