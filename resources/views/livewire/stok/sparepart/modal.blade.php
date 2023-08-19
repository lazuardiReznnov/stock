<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="sparepartStockModal"
    tabindex="-1"
    aria-labelledby="sparepartStockModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="sparepartStockModalLabel">
                    Add Sparepart Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveSparepart">
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
                        <select
                            id="unit"
                            class="form-select @error('category_id') is-invalid @enderror"
                            name="category_id"
                            wire:model="category_id"
                        >
                            <option>Choose Categories ...</option>
                            @foreach($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3" wire:ignore>
                        <select
                            id="unit"
                            class="form-select @error('selectedBrands') is-invalid @enderror"
                            name="selectedBrands"
                            wire:model="selectedBrands"
                        >
                            <option>Choose Brands ...</option>
                            @foreach($brands as $brand)

                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('selectedBrands')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if(!is_null($selectedBrands))
                    <div class="col-md-8 mb-3">
                        <select
                            id="type_id"
                            class="form-select @error('type_id') is-invalid @enderror"
                            name="type_id"
                            wire:model="type_id"
                        >
                            <option>Choose Type ...</option>
                            @foreach($types as $type)

                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>

                            @endforeach
                        </select>

                        @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Sparepart Name"
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
                            class="form-control @error('code') is-invalid @enderror"
                            placeholder="Sparepart code"
                            wire:model="code"
                        />
                        @error('code')
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
                            placeholder="description"
                        ></textarea>
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
