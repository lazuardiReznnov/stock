<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/sparepart"
                name="Sparepart"
            />
            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Upload Sparepart </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/stock/sparepart/store-excl"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="col-md-8">
                        <input
                            type="file"
                            id="excl"
                            class="form-control @error('excl') is-invalid @enderror"
                            placeholder="File"
                            name="excl"
                            onchange="previewImage()"
                        />
                        @error('excl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            Upload
                        </button>
                    </div>
                </form>
                <!-- End No Labels Form -->
            </x-card>
        </div>
    </div>
</x-dashboard>
