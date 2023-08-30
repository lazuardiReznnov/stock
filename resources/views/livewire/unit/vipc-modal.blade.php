<!-- Modal Edit -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateVipcModal"
    tabindex="-1"
    aria-labelledby="updateVipcModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateVpicModalLabel">
                    Edit Vipc
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateVpic">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        @if($oldPic)
                        <img
                            width="200"
                            class="img-fluid mb-2"
                            alt=""
                            src="{{ asset('storage/'.$oldPic) }}"
                        />
                        <input type="hidden" name="" wire:model="oldPic" />
                        <input type="hidden" name="" wire:model="oldPicId" />
                        @endif @if($pic)
                        <img
                            width="200"
                            class="img-fluid mb-2"
                            alt=""
                            src="{{ $pic->temporaryUrl() }}"
                        />
                        @endif
                        <input
                            type="file"
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
                            id="regnumber"
                            type="text"
                            class="form-control @error('regnumber') is-invalid @enderror"
                            name="regnumber"
                            placeholder="Registration Number"
                            wire:model="regnumber"
                        />

                        @error('regnumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="owner"
                            type="text"
                            class="form-control @error('owner') is-invalid @enderror"
                            name="owner"
                            placeholder="Owner Name"
                            wire:model="owner"
                        />

                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="address"
                            type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="address "
                            name="address"
                            wire:model="address"
                        />
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="region"
                            type="text"
                            class="form-control @error('region') is-invalid @enderror"
                            placeholder="region "
                            name="region"
                            wire:model="region"
                        />
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="tgl_reg"
                            type="date"
                            class="form-control @error('tgl_reg') is-invalid @enderror"
                            placeholder="tgl_reg "
                            name="tgl_reg"
                            wire:model="tgl_reg"
                        />
                        @error('tgl_reg')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            id="expire"
                            type="date"
                            class="form-control @error('expire') is-invalid @enderror"
                            placeholder="expire "
                            name="expire"
                            wire:model="expire"
                        />
                        @error('expire')
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
