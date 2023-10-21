<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="employeeModal"
    tabindex="-1"
    aria-labelledby="employeeModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="employeeModalLabel">
                    Add Employee
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveEmployee">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        @if($pic)
                        <img
                            width="200"
                            class="img-fluid mb-2"
                            alt=""
                            src="{{ $pic->temporaryUrl() }}"
                        />
                        @endif
                        <input
                            type="file"
                            id="pic"
                            class="form-control @error('pic') is-invalid @enderror"
                            placeholder="Image"
                            name="pic"
                            wire:model="pic"
                        />
                        @error('pic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Sure Name"
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
                        <input
                            type="text"
                            class="form-control @error('identity') is-invalid @enderror"
                            placeholder="Indentity Number"
                            name="indentity"
                            wire:model="identity"
                        />
                        @error('identity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Phone Number"
                            name="phone"
                            wire:model="phone"
                        />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <textarea
                            class="form-control @error('address') is-invalid @enderror"
                            id="addresss"
                            name="address"
                            rows="3"
                            wire:model="address"
                            placeholder="address"
                        ></textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email"
                            name="email"
                            wire:model="email"
                        />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('position') is-invalid @enderror"
                            placeholder="position"
                            name="position"
                            wire:model="position"
                        />
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('skill') is-invalid @enderror"
                            placeholder="skill"
                            name="skill"
                            wire:model="skill"
                        />
                        @error('skill')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="birth" class="form-label">birth</label>
                        <input
                            type="date"
                            class="form-control @error('birth') is-invalid @enderror"
                            placeholder="birth"
                            name="birth"
                            wire:model="birth"
                        />
                        @error('birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="born" class="form-label">Born</label>
                        <input
                            type="text"
                            class="form-control @error('born') is-invalid @enderror"
                            placeholder="born"
                            name="born"
                            wire:model="born"
                        />
                        @error('born')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('gender') is-invalid @enderror"
                            placeholder="gender Male/Female"
                            name="gender"
                            wire:model="gender"
                        />
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('martial') is-invalid @enderror"
                            placeholder="martial State"
                            name="martial"
                            wire:model="martial"
                        />
                        @error('martial')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('relegion') is-invalid @enderror"
                            placeholder="relegion State"
                            name="relegion"
                            wire:model="relegion"
                        />
                        @error('relegion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('weight') is-invalid @enderror"
                            placeholder="weight "
                            name="weight"
                            wire:model="weight"
                        />
                        @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('height') is-invalid @enderror"
                            placeholder="height "
                            name="height"
                            wire:model="height"
                        />
                        @error('height')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('tin') is-invalid @enderror"
                            placeholder="Tax Identity Number "
                            name="tin"
                            wire:model="tin"
                        />
                        @error('tin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('driver_license') is-invalid @enderror"
                            placeholder="Driver License "
                            name="driver_license"
                            wire:model="driver_license"
                        />
                        @error('driver_license')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="entry" class="form-label">Entry Date</label>
                        <input
                            type="date"
                            class="form-control @error('entry') is-invalid @enderror"
                            placeholder="entry"
                            name="entry"
                            wire:model="entry"
                        />
                        @error('entry')
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
                    <div wire:loading>Save...</div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endinput -->
