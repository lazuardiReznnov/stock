<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="typeModal"
    tabindex="-1"
    aria-labelledby="typeModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="typeModalLabel">
                    Add Model Unit
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveType">
                <div class="modal-body">
                    <div class="col-md-8 mb-3" wire:ignore.self>
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
                        <select
                            id="brand_id"
                            class="form-select"
                            name="brand_id"
                            wire:model="brand_id"
                        >
                            <option selected>Choose Brands ...</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" selected>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('brand_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <select
                            id="category_unit_id"
                            class="form-select"
                            name="category_unit_id"
                            wire:model="category_unit_id"
                        >
                            <option selected>Choose Category Unit ...</option>
                            @foreach($categoryUnits as $categoryUnit)

                            <option value="{{ $categoryUnit->id }}" selected>
                                {{ $categoryUnit->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('categoryUnit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Brand Name"
                            name="name"
                            wire:model="name"
                        />
                        @error('name')
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

<!-- Modal Edit -->
<div
    wire:ignore.self
    class="modal fade"
    id="updateTypeModal"
    tabindex="-1"
    aria-labelledby="updateTypeModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateTypeModalLabel">
                    Edit Type
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateGroup">
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
                        <select
                            wire:model="brand_id"
                            id="brand_id"
                            class="form-select"
                            name="brand_id"
                        >
                            <option selected>Choose Brands ...</option>
                            @foreach($brands as $brand)

                            <option value="{{ $brand->id }}" selected>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('brand_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <select
                            id="category_unit_id"
                            class="form-select"
                            name="category_unit_id"
                            wire:model="category_unit_id"
                        >
                            <option selected>Choose Category Unit ...</option>
                            @foreach($categoryUnits as $categoryUnit)

                            <option value="{{ $categoryUnit->id }}" selected>
                                {{ $categoryUnit->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('categoryUnit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Brand Name"
                            name="name"
                            wire:model="name"
                        />
                        @error('name')
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

<!-- modal Delete -->
<div
    wire:ignore.self
    class="modal fade"
    id="deleteTypeModal"
    tabindex="-1"
    aria-labelledby="deleteTypeModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteTypeModalLabel">
                    Delete Type Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyType">
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
