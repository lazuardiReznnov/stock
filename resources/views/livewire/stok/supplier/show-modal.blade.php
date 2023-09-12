<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="supplierInvoiceModal"
    tabindex="-1"
    aria-labelledby="supplierInvoiceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="supplierInvoiceModalLabel">
                    Create Invoice data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveSupplierInvoice">
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
                            type="date"
                            class="form-control @error('tgl') is-invalid @enderror"
                            placeholder="Date"
                            name="tgl"
                            value="{{ old('tgl') }}"
                            wire:model="tgl"
                        />
                        @error('tgl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Invoice Number"
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
                            id="method"
                            type="text"
                            class="form-control @error('method') is-invalid @enderror"
                            placeholder="method "
                            name="method"
                            value="{{ old('method') }}"
                            wire:model="method"
                        />
                        @error('method')
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

<!-- Update Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateSupplierInvoiceModal"
    tabindex="-1"
    aria-labelledby="updateSupplierInvoiceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="updateSupplierInvoiceModalLabel"
                >
                    Update Invoice data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateSupplierInvoice">
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
                            type="date"
                            class="form-control @error('tgl') is-invalid @enderror"
                            placeholder="Date"
                            name="tgl"
                            value="{{ old('tgl') }}"
                            wire:model="tgl"
                        />
                        @error('tgl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Invoice Number"
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
                            id="method"
                            type="text"
                            class="form-control @error('method') is-invalid @enderror"
                            placeholder="method "
                            name="method"
                            value="{{ old('method') }}"
                            wire:model="method"
                        />
                        @error('method')
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
<!-- Update endinput -->

<!-- modal Delete -->
<div
    wire:ignore.self
    class="modal fade"
    id="deleteSupplierInvoiceModal"
    tabindex="-1"
    aria-labelledby="deleteSupplierInvoiceModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="deleteSupplierInvoiceModalLabel"
                >
                    Delete Invoice Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroySupplierInvoice">
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

<div
    wire:ignore.self
    class="modal fade"
    id="showImageModal"
    tabindex="-1"
    aria-labelledby="showImageModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showImageModalLabel">Image</h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>

            <div class="modal-body">
                @if($image)
                <img
                    width="500"
                    class="img-fluid mb-2"
                    alt=""
                    src="{{ asset('storage/'.$image) }}"
                />

                @endif
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
            </div>
        </div>
    </div>
</div>
