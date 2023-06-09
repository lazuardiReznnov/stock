<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/unit/{{ $data->slug }}"
                name="{{ $data->name }}"
            />
            <x-breadcrumb-item link="" name="Spesification " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Edit Spesification</x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/unit/spesification/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("VIN")
                        }}</label>
                        <input
                            id="vin"
                            type="text"
                            class="form-control @error('vin') is-invalid @enderror"
                            name="vin"
                            placeholder="Vin Number"
                            value="{{ old('vin', $data->spesification->vin) }}"
                        />

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Engine Number")
                        }}</label>
                        <input
                            id="en"
                            type="text"
                            class="form-control @error('en') is-invalid @enderror"
                            placeholder="Engine Number "
                            name="en"
                            value="{{ old('en', $data->spesification->en) }}"
                        />
                        @error('en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Year")
                        }}</label>
                        @php $now = date('Y'); @endphp
                        <select name="year" class="form-select">
                            <option selected>--Choice Year--</option>
                            @for ($a=2012;$a<=$now;$a++)
                            @if(old($a,$data->spesification->year)==$a)
                            <option value="{{ $a }}" selected>
                                {{ $a }}
                            </option>
                            @else
                            <option value="{{ $a }}">
                                {{ $a }}
                            </option>
                            @endif @endfor
                        </select>
                        @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Color")
                        }}</label>
                        <input
                            id="color"
                            type="text"
                            class="form-control @error('color') is-invalid @enderror"
                            placeholder="color"
                            name="color"
                            value="{{ old('color', $data->spesification->en) }}"
                        />
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Model")
                        }}</label>
                        <input
                            id="model"
                            type="text"
                            class="form-control @error('model') is-invalid @enderror"
                            placeholder="model"
                            name="model"
                            value="{{ old('model', $data->spesification->model) }}"
                        />
                        @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Cylinder")
                        }}</label>
                        <input
                            id="cylinder"
                            type="text"
                            class="form-control @error('cylinder') is-invalid @enderror"
                            placeholder="cylinder"
                            name="cylinder"
                            value="{{ old('cylinder', $data->spesification->cylinder) }}"
                        />
                        @error('cylinder')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="fuel" class="col-md-4 col-form-label">{{
                            __("Fuel")
                        }}</label>
                        <input
                            id="fuel"
                            type="text"
                            class="form-control @error('fuel') is-invalid @enderror"
                            placeholder="fuel"
                            name="fuel"
                            value="{{ old('fuel', $data->spesification->fuel) }}"
                        />
                        @error('fuel')
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
