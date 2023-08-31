<div>
    @include('livewire\unit\spec-modal')
    <div class="row">
        <div class="col-md-12">
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

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Model</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->model }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Vin</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->vin }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Engine Number</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->en }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Year</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->year }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Color</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->color }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Fuel</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->fuel }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Cylinder</div>
        <div class="col-lg-9 col-md-8">
            {{ $spec->cylinder }}
        </div>
    </div>

    <x-button-link
        href="#"
        class="btn-warning"
        data-bs-toggle="modal"
        data-bs-target="#updateSpecModal"
        title="Edit Spesification"
        wire:click="editSpec({{ $spec->id }})"
        ><i class="bi bi-pencil-square"> Edit Spesification</i>
    </x-button-link>
</div>
