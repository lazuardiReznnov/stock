<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item link="" name="VPIC " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Edit Inspection Card Data</x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/unit/vpic/{{ $data->slug }}"
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
                            src="{{ asset('storage/'. $data->vpic->image->pic) }}"
                        />
                        <input
                            type="hidden"
                            name="old_pic"
                            value="{{ $data->vpic->image->pic }}"
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
                            value="{{ old('regnumber', $data->vpic->regnumber) }}"
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
                            value="{{ old('owner', $data->vpic->owner) }}"
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
                            value="{{ old('address', $data->vpic->address) }}"
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
                            value="{{ old('region', $data->vpic->region) }}"
                        />
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="tgl_reg"
                            type="date"
                            class="form-control @error('tgl_reg') is-invalid @enderror"
                            placeholder="tgl_reg "
                            name="tgl_reg"
                            value="{{ old('tgl_reg', $data->vpic->tgl_reg) }}"
                        />
                        @error('tgl_reg')
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
                            value="{{ old('expire', $data->vpic->expire) }}"
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
    @push('script2')

    <script>
        //  slug alternatif`

        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const pic = document.getElementById("#pic");
        const brand = document.querySelector("#brand");
        const type = document.querySelector("#type");
        const link = "/dashboard/unit/checkSlug?name=";
        const link2 = "/dashboard/unit/getType?brand=";

        makeslug(name, slug, link);

        makeBrand(brand, type, link2);
    </script>

    @endpush @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
