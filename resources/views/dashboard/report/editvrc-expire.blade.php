<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/report" name="report" />
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
                    action="/dashboard/report/vrc/expire/{{ $data->slug }}"
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
