<div>
    <x-card-title>Vehicle Registration Certificate</x-card-title>
    @if($data)
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
                href="/dashboard/unit/vrc/{{ $data->slug }}"
                class="btn btn-warning"
                >Edit Data</a
            >
        </div>
    </div>
    @endif
</div>
