<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Input Unit</x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/unit"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="col-md-8">
                        <img
                            width="200"
                            class="img-preview img-fluid mb-2"
                            alt=""
                        />

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
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Registration Number"
                            value="{{ old('name') }}"
                        />

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <input
                            id="slug"
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="Slug "
                            name="slug"
                            value="{{ old('slug') }}"
                        />
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <select
                            id="category"
                            class="form-select"
                            name="category_unit_id"
                        >
                            <option selected>Choose Category Unit ...</option>
                            @foreach($categories as $category)
                            @if(old('category_unit_id')==$category->id)
                            <option value="{{ $category->id }}" selected>
                                {{ $category->name }}
                            </option>
                            @else
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('category_unit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <select id="brand" class="form-select" name="brand">
                            <option selected>Choose brand ...</option>
                            @foreach($brands as $brand)
                            @if(old('brand_id')==$brand->id)
                            <option value="{{ $brand->id }}" selected>
                                {{ $brand->name }}
                            </option>
                            @else
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <select
                            id="type"
                            class="form-select"
                            name="type_id"
                        ></select>

                        @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <select
                            id="group_id"
                            class="form-select"
                            name="group_id"
                        >
                            <option selected>Choose Group ...</option>
                            @foreach($groups as $group)
                            @if(old('group_id')==$group->id)
                            <option value="{{ $group->id }}" selected>
                                {{ $group->name }}
                            </option>
                            @else
                            <option value="{{ $group->id }}">
                                {{ $group->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('group_id')
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
        const brand = document.querySelector("#brand");
        const category = document.querySelector("#category");
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
