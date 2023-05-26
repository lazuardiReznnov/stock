<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/invoiceStock"
                name="invoice"
            />
            <x-breadcrumb-item link="" name=" Edit Stock In " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form </x-card-title>

                <form
                    class="row g-3"
                    action="/dashboard/stock/invoiceStock/stock-in/{{ $data->slug }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf @method('put')

                    <input
                        type="hidden"
                        name="invoice_slug"
                        value="{{ $invoice->slug }}"
                    />
                    <input
                        type="hidden"
                        name="invoice_stock_id"
                        value="{{ $invoice->id }}"
                    />
                    <div class="col-md-8">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            placeholder="Description"
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
                        <input
                            id="brand"
                            type="text"
                            class="form-control @error('brand') is-invalid @enderror"
                            placeholder="Brand "
                            name="brand"
                            value="{{ old('brand', $data->brand) }}"
                        />
                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <select
                            id="sparepart"
                            class="form-select"
                            name="sparepart_id"
                        >
                            <option selected>Choose Sparepart ...</option>
                            @foreach($spareparts as $sparepart)
                            @if(old('sparepart_id',
                            $data->sparepart_id)==$sparepart->id)
                            <option value="{{ $sparepart->id }}" selected>
                                {{ $sparepart->type->name }} -
                                {{ $sparepart->name }}
                            </option>
                            @else
                            <option value="{{ $sparepart->id }}">
                                {{ $sparepart->type->name }} -
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
                            type="text"
                            class="form-control @error('qty') is-invalid @enderror"
                            placeholder="qty"
                            name="qty"
                            value="{{ old('qty', $data->qty) }}"
                        />
                        @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <input
                            type="text"
                            class="form-control @error('price') is-invalid @enderror"
                            placeholder="price"
                            name="price"
                            value="{{ old('price', $data->price) }}"
                        />
                        @error('price')
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
        const link = "/dashboard/stock/invoiceStock/stock-in/checkSlug?name=";

        makeslug(name, slug, link);
    </script>

    @endpush @push('script')
    <script src="/assets/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
