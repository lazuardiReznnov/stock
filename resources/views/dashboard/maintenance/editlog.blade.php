<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/maintenance"
                name="maintenance"
            />
            <x-breadcrumb-item
                link="/dashboard/maintenance/{{ $data->maintenance->slug}}"
                name="{{ $data->maintenance->unit->name }}"
            />

            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Log State </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/maintenance/logstate/{{ $data->maintenance->slug }}/{{ $data->id }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <div class="col-md-8">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Log Name"
                            value="{{ old('name', $data->name) }}"
                        />

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <input
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="description"
                            name="description"
                            value="{{ old('description', $data->description) }}"
                        />
                        @error('description')
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
</x-dashboard>
