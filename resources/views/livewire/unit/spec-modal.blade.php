<!-- Modal Edit -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateSpecModal"
    tabindex="-1"
    aria-labelledby="updateSpecModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateSpecModalLabel">
                    Edit VRC
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateSpec">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <input
                            id="vin"
                            type="text"
                            class="form-control @error('vin') is-invalid @enderror"
                            name="vin"
                            placeholder="Registration Number"
                            wire:model="vin"
                        />

                        @error('vin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="en"
                            type="text"
                            class="form-control @error('en') is-invalid @enderror"
                            name="en"
                            placeholder="engine Numb"
                            wire:model="en"
                        />

                        @error('en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="color"
                            type="text"
                            class="form-control @error('color') is-invalid @enderror"
                            placeholder="color "
                            name="color"
                            wire:model="color"
                        />
                        @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="model"
                            type="text"
                            class="form-control @error('model') is-invalid @enderror"
                            placeholder="model "
                            name="model"
                            wire:model="model"
                        />
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        @php $now = date('Y'); @endphp
                        <select
                            name="year"
                            class="form-select"
                            wire:model="year"
                        >
                            <option selected>--Choice Year--</option>
                            @for ($a=2012;$a<=$now;$a++)
                            <option value="{{ $a }}" selected>
                                {{ $a }}
                            </option>
                            @endfor
                        </select>
                        @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="fuel"
                            type="text"
                            class="form-control @error('fuel') is-invalid @enderror"
                            placeholder="fuel "
                            name="fuel"
                            wire:model="fuel"
                        />
                        @error('fuel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            id="cylinder"
                            type="date"
                            class="form-control @error('cylinder') is-invalid @enderror"
                            placeholder="cylinder "
                            name="cylinder"
                            wire:model="cylinder"
                        />
                        @error('cylinder')
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
<!-- end Edit -->
