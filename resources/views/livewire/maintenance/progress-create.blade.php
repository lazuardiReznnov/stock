<div>
    <div class="row">
        <div class="col-md-8">
            @if(session()->has('success'))

            <!-- pesan -->

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session("success") }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="close"
                ></button>
            </div>

            <!-- endpesan -->

            @endif
        </div>
    </div>
    <form class="row g-3" wire:submit.prevent="store">
        <div class="col-md-6">
            <input
                id="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                wire:model="name"
                placeholder="Log Name"
                value="{{ old('name') }}"
            />

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-12">
            <textarea
                name=""
                wire:model="description"
                id=""
                cols="10"
                rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="description"
                >{{ old("description") }}</textarea
            >

            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-4">
            <input
                type="text"
                class="form-control @error('progress') is-invalid @enderror"
                placeholder="progress"
                name="progress"
                wire:model="progress"
                value="{{ old('progress') }}"
            />
            @error('progress')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
