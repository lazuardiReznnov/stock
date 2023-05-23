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
                <x-card-title> Form Sparepart </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/stock/sparepart/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <div class="col-md-8">
                        @if($data->image)
                        <img
                            width="200"
                            class="img-fluid mb-2"
                            alt=""
                            src="{{ asset('storage/'. $data->image->pic) }}"
                        />
                        <input
                            type="hidden"
                            name="old_pic"
                            value="{{ $data->image->pic }}"
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
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Sparepart Name"
                            value="{{ old('name', $data->name) }}"
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
                            value="{{ old('slug', $data->slug) }}"
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
                            name="category_id"
                        >
                            <option selected>Choose category ...</option>
                            @foreach($categories as $category)
                            @if(old('category_id',
                            $data->category_id)==$category->id)
                            <option value="{{ $category->id }}" selected>
                                {{ $category->name }}
                            </option>
                            @else
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <select id="type" class="form-select" name="type_id">
                            <option selected>Choose Type ...</option>
                            @foreach($types as $type) @if(old('type_id',
                            $data->type_id)==$type->id)
                            <option value="{{ $type->id }}" selected>
                                {{ $type->name }}
                            </option>
                            @else
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            type="text"
                            class="form-control @error('code') is-invalid @enderror"
                            placeholder="code"
                            name="code"
                            value="{{ old('code', $data->code) }}"
                        />
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <input
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Description"
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
