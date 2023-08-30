<div>
    @include('livewire\unit\vrc-modal')
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
    <x-card-title>Vehicle Registration Certificate</x-card-title>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Owner</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->owner }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Address</div>
        <div class="col-lg-9 col-md-8">
            {{ $data->address }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Tax Expire</div>
        <div class="col-lg-9 col-md-8">
            {{ \Carbon\Carbon::parse($data->tax)->format('d/m/Y') }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Expire Date</div>
        <div class="col-lg-9 col-md-8">
            {{ \Carbon\Carbon::parse($data->expire)->format('d/m/Y') }}
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md">
            @if($data->image)
            <img
                width="100"
                class="rounded img-fluid mb-2"
                alt=""
                src="{{ asset('storage/'. $data->vrc->image->pic) }}"
            />

            @else
            <img
                width="50"
                class="rounded img-fluid mb-2"
                alt=""
                src="http://source.unsplash.com/50x50?smartphones"
            />
            @endif
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md">
            <a
                href="#"
                class="btn btn-warning"
                data-bs-toggle="modal"
                data-bs-target="#updateVrcModal"
                title="Edit Vrc"
                wire:click="editVrc({{ $data->id }})"
                >Edit Data</a
            >
        </div>
    </div>
</div>
