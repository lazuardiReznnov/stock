<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item
                link="/dashboard/unit/{{ $data->slug }}"
                name="{{ $data->name }}"
            />
            <x-breadcrumb-item link="" name="VRC " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Edit Inspection Card Data</x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/unit/vrc/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')
                    <div class="col-md-8">
                        @if($data->vpic->image)
                        <img
                            width="200"
                            class="img-fluid mb-2"
                            alt=""
                            src="{{ asset('storage/'. $data->vrc->image->pic) }}"
                        />
                        <input
                            type="hidden"
                            name="old_pic"
                            value="{{ $data->vrc->image->pic }}"
                        />

                        @else
                        <img
                            width="200"
                            class="img-preview img-fluid mb-2"
                            alt=""
                        />
                        @endif

                        <input
                            type="file"
                            id="pic"
                            class="form-control @error('pic') is-invalid @enderror"
                            placeholder="Image"
                            name="pic"
                            onchange="previewImage()"
                        />
                        @error('pic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="regnumber"
                            type="text"
                            class="form-control @error('regnumber') is-invalid @enderror"
                            name="regnumber"
                            placeholder="Registration Number"
                            value="{{ old('regnumber', $data->vrc->regnumber) }}"
                        />

                        @error('regnumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="owner"
                            type="text"
                            class="form-control @error('owner') is-invalid @enderror"
                            name="owner"
                            placeholder="Owner Name"
                            value="{{ old('owner', $data->vrc->owner) }}"
                        />

                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="address"
                            type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="address "
                            name="address"
                            value="{{ old('address', $data->vrc->address) }}"
                        />
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="region"
                            type="text"
                            class="form-control @error('region') is-invalid @enderror"
                            placeholder="region "
                            name="region"
                            value="{{ old('region', $data->vrc->region) }}"
                        />
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="tax"
                            type="date"
                            class="form-control @error('tax') is-invalid @enderror"
                            placeholder="tax "
                            name="tax"
                            value="{{ old('tax', $data->vrc->tax) }}"
                        />
                        @error('tax')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            id="expire"
                            type="date"
                            class="form-control @error('expire') is-invalid @enderror"
                            placeholder="expire "
                            name="expire"
                            value="{{ old('expire', $data->vrc->expire) }}"
                        />
                        @error('expire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
                <!-- End No Labels Form -->
            </x-card>
        </div>
    </div>
    @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
