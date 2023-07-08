<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/maintenance"
                name="maintenance"
            />
            <x-breadcrumb-item
                link="/dashboard/maintenance/{{ $data->slug}}"
                name="{{ $data->unit->name }}"
            />

            <x-breadcrumb-item link="" name="Sparepart " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Replacing Sparepart </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/maintenance/sparepart/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="col-md-8">
                        <select
                            id="unit"
                            class="form-select"
                            name="sparepart_id"
                        >
                            <option selected>Choose sparepart ...</option>
                            @foreach($spareparts as $sparepart)
                            @if(old('sparepart_id')==$sparepart->id)
                            <option value="{{ $sparepart->id }}" selected>
                                {{ $sparepart->name }}
                            </option>
                            @else
                            <option value="{{ $sparepart->id }}">
                                {{ $sparepart->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('sparepart_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            id="qty"
                            type="text"
                            class="form-control @error('qty') is-invalid @enderror"
                            placeholder="qty"
                            name="qty"
                            value="{{ old('qty') }}"
                        />
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
                <!-- End No Labels Form -->
            </x-card>
        </div>
    </div>
</x-dashboard>
