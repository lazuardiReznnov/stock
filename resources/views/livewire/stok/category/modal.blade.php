<!-- input -->
<!-- Modal input -->
<div
    wire:ignore.self
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
    aria-labelledby="categoryModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryModalLabel">
                    Add category
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="saveCategory">
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
    id="updateCategoryModal"
    tabindex="-1"
    aria-labelledby="updateCategoryModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateCategoryModalLabel">
                    Add Category
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="updateCategory">
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
    id="deleteCategoryModal"
    tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">
                    Delete Category Data
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    wire:click="closeModal"
                ></button>
            </div>
            <form wire:submit.prevent="destroyCategory">
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
