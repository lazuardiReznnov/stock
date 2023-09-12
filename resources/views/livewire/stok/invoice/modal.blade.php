<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="invoiceStockModal"
    tabindex="-1"
    aria-labelledby="invoiceStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="invoiceStockModalLabel">
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
            <form wire:submit.prevent="saveInvoiceStock">
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
                        <select
                            id="supplier"
                            class="form-select"
                            name="supplier_id"
                            wire:model="supplier_id"
                        >
                            <option selected>Choose Supplier ...</option>
                            @foreach($suppliers as $supplier)
                            @if(old('supplier_id')==$supplier->id)
                            <option value="{{ $supplier->id }}" selected>
                                {{ $supplier->name }}
                            </option>
                            @else
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('supplier_id')
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
    id="updateInvoiceStockModal"
    tabindex="-1"
    aria-labelledby="updateInvoiceStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateInvoiceStockModalLabel">
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
            <form wire:submit.prevent="updateInvoiceStock">
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
                        <select
                            id="supplier"
                            class="form-select"
                            name="supplier_id"
                            wire:model="supplier_id"
                        >
                            <option selected>Choose Supplier ...</option>
                            @foreach($suppliers as $supplier)
                            @if(old('supplier_id')==$supplier->id)
                            <option value="{{ $supplier->id }}" selected>
                                {{ $supplier->name }}
                            </option>
                            @else
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('supplier_id')
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
    id="deleteInvoiceStockModal"
    tabindex="-1"
    aria-labelledby="deleteInvoiceStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteInvoiceStockModalLabel">
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
            <form wire:submit.prevent="destroyInvoiceStock">
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
