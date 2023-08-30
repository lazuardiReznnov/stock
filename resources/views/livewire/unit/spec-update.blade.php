<div wire:ignore.self>
    @include('livewire\unit\spec-modal') @if($data)
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Model</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->model }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Vin</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->vin }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Engine Number</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->en }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Year</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->year }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Color</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->color }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Fuel</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->fuel }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Cylinder</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->cylinder }}
        </div>
    </div>

    <x-button-link
        href="#"
        class="btn-warning"
        data-bs-toggle="modal"
        data-bs-target="#updateSpecModal"
        title="Edit Spesification"
        wire:click="editSpec({{ $data->id }})"
        ><i class="bi bi-pencil-square"> Edit Spesification</i>
    </x-button-link>
    @endif
</div>
