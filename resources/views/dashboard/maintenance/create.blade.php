<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/maintenance"
                name="maintenance"
            />

            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Maintenance </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/maintenance"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="col-md-8">
                        <select id="unit" class="form-select" name="unit_id">
                            <option selected>Choose unit ...</option>
                            @foreach($units as $unit)
                            @if(old('unit_id')==$unit->id)
                            <option value="{{ $unit->id }}" selected>
                                {{ $unit->name }}
                            </option>
                            @else
                            <option value="{{ $unit->id }}">
                                {{ $unit->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('unit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            type="date"
                            class="form-control @error('tgl') is-invalid @enderror"
                            placeholder="Date"
                            name="tgl"
                            value="{{ old('tgl') }}"
                        />
                        @error('tgl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <textarea
                            class="form-control tinymce-editor"
                            id="descriptions"
                            name="description"
                            rows="3"
                            >{{ old("description") }}</textarea
                        >
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <textarea
                            class="form-control tinymce-editor"
                            id="instruction"
                            name="instruction"
                            rows="3"
                            >{{ old("instruction") }}</textarea
                        >
                        @error('instruction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="estimate"
                            type="text"
                            class="form-control @error('estimate') is-invalid @enderror"
                            placeholder="estimate Per Day"
                            name="estimate"
                            value="{{ old('estimate') }}"
                        />
                        @error('estimate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="mechanic"
                            type="text"
                            class="form-control @error('mechanic') is-invalid @enderror"
                            placeholder="Mechanic "
                            name="mechanic"
                            value="{{ old('mechanic') }}"
                        />
                        @error('mechanic')
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
    @push('script2')

    <script>
        //  slug alternatif`

        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const pic = document.getElementById("#pic");
        const link = "/dashboard/stock/sparepart/checkSlug?name=";

        makeslug(name, slug, link);
    </script>

    @endpush @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
