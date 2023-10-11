@push('css')
<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>
@endpush

<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="stockModal"
    tabindex="-1"
    aria-labelledby="stockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="stockModalLabel">
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
            <form wire:submit.prevent="saveStock">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="sparepart"
                            class="form-select"
                            name="sparepart_id"
                            wire:model="sparepart_id"
                        >
                            <option selected>Choose Sparepart ...</option>
                            @foreach($spareparts as $sparepart)

                            <option value="{{ $sparepart->id }}" selected>
                                {{ $sparepart->type->name }} -
                                {{ $sparepart->name }}
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
                            id="brand"
                            type="text"
                            class="form-control @error('brand') is-invalid @enderror"
                            placeholder="Brand "
                            name="brand"
                            value="{{ old('brand') }}"
                            wire:model="brand"
                        />
                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
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

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('price') is-invalid @enderror"
                            placeholder="price"
                            name="price"
                            value="{{ old('price') }}"
                            wire:model="price"
                        />
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3" wire:ignore>
                        <select
                            class="form-select @error('tag_id') is-invalid @enderror js-example-basic-multiple"
                            id="selec2"
                            aria-label="tag"
                            name="tag_id[]"
                            multiple="multiple"
                            placeholder="Tags"
                            wire:model.lazy="tag_id"
                        >
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" selected>
                                {{ $tag->name }}
                            </option>

                            @endforeach
                        </select>
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
<!-- Modal edit -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateStockModal"
    tabindex="-1"
    aria-labelledby="updateStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateStockModalLabel">
                    Update data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateStock">
                <div class="modal-body">
                    <div class="col-md-8 mb-3">
                        <select
                            id="sparepart"
                            class="form-select"
                            name="sparepart_id"
                            wire:model="sparepart_id"
                        >
                            <option selected>Choose Sparepart ...</option>
                            @foreach($spareparts as $sparepart)

                            <option value="{{ $sparepart->id }}" selected>
                                {{ $sparepart->type->name }} -
                                {{ $sparepart->name }}
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
                            id="brand"
                            type="text"
                            class="form-control @error('brand') is-invalid @enderror"
                            placeholder="Brand "
                            name="brand"
                            value="{{ old('brand') }}"
                            wire:model="brand"
                        />
                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
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

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('price') is-invalid @enderror"
                            placeholder="price"
                            name="price"
                            value="{{ old('price') }}"
                            wire:model="price"
                        />
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3" wire:ignore>
                        <select
                            class="form-select @error('tag_id') is-invalid @enderror js-example-basic-multiple"
                            id="selec2"
                            aria-label="tag"
                            name="tag_id[]"
                            multiple="multiple"
                            placeholder="Tags"
                            wire:model="tag_id"
                        >
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" selected>
                                {{ $tag->name }}
                            </option>

                            @endforeach
                        </select>
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
<!-- endinput -->

<div
    wire:ignore.self
    class="modal fade"
    id="deleteStockModal"
    tabindex="-1"
    aria-labelledby="deleteStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteStockModalLabel">
                    Delete Stock Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyStock">
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
@push('script')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".js-example-basic-multiple").select2({ placeholder: "Tags" });
        $('.js-example-basic-multiple').on('change', function (e) {
            let data = $(this).val();
                 @this.set('tag_id', data);
        });
    });
</script>
@endpush
