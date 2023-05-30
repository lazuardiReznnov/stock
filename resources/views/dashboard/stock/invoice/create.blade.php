<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/invoiceStock"
                name="Invoice Stock"
            />
            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form invoice </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/stock/invoiceStock"
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
                    <div class="col-md-8">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Invoice Number"
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
                            id="supplier"
                            class="form-select"
                            name="supplier_id"
                        >
                            <option selected>Choose Supplier ...</option>
                            @foreach($suppliers as $supplier)
                            @if(old('supplier_id')==$supplier->id)
                            <option value="{{ $supplier->id }}" selected>
                                {{ $supplier->name }}
                            </option>
                            @else
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                            </option>

                            @endif @endforeach
                        </select>

                        @error('supplier_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <input
                            id="method"
                            type="text"
                            class="form-control @error('method') is-invalid @enderror"
                            placeholder="method "
                            name="method"
                            value="{{ old('method') }}"
                        />
                        @error('method')
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
        const link = "/dashboard/stock/invoiceStock/checkSlug?name=";

        makeslug(name, slug, link);
    </script>

    @endpush @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
