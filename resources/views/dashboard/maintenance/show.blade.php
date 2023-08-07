<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/maintenance"
                name="maintenance"
            />
            <x-breadcrumb-item link="" name="{{ $title }}" />
        </x-breadcrumb>
    </x-pagetitle>
    <div class="row my-4">
        <div class="col-md-6">
            <x-button-group>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/maintenance"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Back"
                >
                    Back
                </x-button-link>

                <x-button-link
                    href="/dashboard/maintenance/print/{{ $data->slug }}"
                    class="btn-success"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Print SPK"
                    ><i class="bi bi-printer"></i> Print
                </x-button-link>

                <form
                    action="/dashboard/maintenance/{{ $data->slug }}"
                    method="post"
                    class="d-inline"
                >
                    @method('delete') @csrf
                    <x-button-link
                        class="btn btn-danger"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Delete data"
                        onclick="return confirm('are You sure ??')"
                    >
                        <i class="bi bi-x-lg"></i>
                    </x-button-link>
                </form>
            </x-button-group>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if(session()->has('success'))

            <!-- pesan -->

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session("success") }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="close"
                ></button>
            </div>

            <!-- endpesan -->

            @endif
        </div>
    </div>

    <x-section class="profile">
        <div class="row">
            <div class="col-xl-4">
                <x-card2>
                    <x-card-body
                        class="profile-card pt-4 d-flex flex-column align-items-center"
                    >
                        @if($data->unit->image)
                        <img
                            width="200"
                            class="rounded-circle"
                            alt=""
                            src="{{ asset('storage/'. $data->unit->image->pic) }}"
                        />
                        @else

                        <img
                            class="rounded-circle mx-auto d-block shadow my-3"
                            src="http://source.unsplash.com/200x200?smartphones"
                            alt=""
                        />
                        @endif
                        <h2>{{ $data->unit->name }}</h2>
                    </x-card-body>
                </x-card2>
            </div>
            <div class="col-xl-8">
                <x-card2>
                    <x-card-body class="pt-2">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button
                                    class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#profile-overview"
                                >
                                    Overview
                                </button>
                            </li>

                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#spareparts"
                                >
                                    Sparepart
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#progres"
                                >
                                    Maintenance Progress
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#documents"
                                >
                                    Document
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div
                                class="tab-pane fade show active profile-overview"
                                id="profile-overview"
                            >
                                <x-card-title> Spesification </x-card-title>
                                <div class="profile-overview">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Unit
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->unit->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Merk/Type
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->unit->type->brand->name }}
                                            {{ $data->unit->type->name }}
                                        </div>
                                    </div>
                                </div>
                                <x-card-title>Detail Repaired</x-card-title>
                                <div class="profile-overview">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Date
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Description
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {!! $data->description !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Instruction
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {!! $data->instruction !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Estimate
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->estimate }} Day
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade spareparts pt-3"
                                id="spareparts"
                            >
                                <div class="row">
                                    <div class="col-md-12">
                                        <x-card>
                                            <x-card-title>
                                                Replacing Sparepart
                                            </x-card-title>

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>

                                                        <th scope="col">
                                                            Sparepart Name
                                                        </th>
                                                        <th scope="col">
                                                            code
                                                        </th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">
                                                            price
                                                        </th>
                                                        <th scope="col">sum</th>

                                                        <th scope="col">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sumttl=0; ?>
                                                    @if($data->maintenancePart->count())
                                                    @foreach($data->maintenancePart
                                                    as $part)
                                                    <tr>
                                                        <th scope="row">
                                                            {{ $loop->iteration }}
                                                        </th>
                                                        <td>
                                                            {{ $part->sparepart->name }}
                                                        </td>
                                                        <td>
                                                            {{ $part->description}}
                                                        </td>
                                                        <td>
                                                            {{ $part->qty }}
                                                        </td>
                                                        <td>
                                                            @currency($part->price)
                                                        </td>
                                                        <td>
                                                            <?php $sum = $part->price*$part->qty
                                                            ?> @currency($sum)
                                                        </td>

                                                        <td>
                                                            <a
                                                                href="/dashboard/maintenance/sparepart/{{ $part->id }}/edit"
                                                                class="badge bg-warning"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Edit maintenance/sparepart"
                                                                ><i
                                                                    class="bi bi-pencil-square"
                                                                ></i
                                                            ></a>

                                                            <form
                                                                action="/dashboard/maintenance/sparepart/{{ $part->id }}"
                                                                method="post"
                                                                class="d-inline"
                                                            >
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="badge bg-danger border-0"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Delete Unit"
                                                                    onclick="return confirm('are You sure ??')"
                                                                >
                                                                    <i
                                                                        class="bi bi-x-lg"
                                                                    ></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <!-- Modal Image -->
                                                    </tr>
                                                    <?php $sumttl = $sumttl+$sum ?>
                                                    @endforeach
                                                    <tr class="fw-bold">
                                                        <td colspan="5">
                                                            Grand Total
                                                        </td>
                                                        <td>
                                                            @currency($sumttl)
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td
                                                            colspan="6"
                                                            class="text-center"
                                                        >
                                                            Data Not Found
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </x-card>

                                        <x-button-link
                                            href="/dashboard/maintenance/sparepart/{{ $data->slug }}"
                                            class="btn-success"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Sparepart maintenance"
                                        >
                                            add Sparepart
                                        </x-button-link>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="tab-pane fade documents pt-3"
                                id="documents"
                            >
                                @if($data->image)
                                <div class="row">
                                    @foreach($data->image as $pic)
                                    <div class="col">
                                        <x-card2>
                                            <x-card-body class="my-2">
                                                <img
                                                    width="300"
                                                    class=""
                                                    alt=""
                                                    src="{{ asset('storage/'. $pic->pic) }}"
                                                />
                                                <form
                                                    action="/dashboard/maintenance/upload/{{ $data->slug }}"
                                                    method="post"
                                                    class="d-inline"
                                                >
                                                    <input
                                                        type="hidden"
                                                        name="id"
                                                        value="{{ $pic->id }}"
                                                    />
                                                    @method('delete') @csrf
                                                    <button
                                                        class="badge bg-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete Image Unit"
                                                        onclick="return confirm('are You sure ??')"
                                                    >
                                                        <i
                                                            class="bi bi-file-x-fill"
                                                        ></i>
                                                    </button>
                                                </form>
                                            </x-card-body>
                                        </x-card2>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                <x-button-link
                                    href="/dashboard/maintenance/upload/{{ $data->slug }}"
                                    class="btn-success"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Image"
                                >
                                    Upload Image
                                </x-button-link>
                            </div>
                            <div
                                class="tab-pane fade progres pt-3"
                                id="progres"
                            >
                                @push('css')
                                <livewire:styles />
                                @endpush @push('script')
                                <livewire:scripts />
                                @endpush @livewire('maintenance.progress.table',
                                ['maintenanceId'=>$data->id])
                            </div>
                        </div>
                    </x-card-body>
                </x-card2>
            </div>
        </div>
    </x-section>
</x-dashboard>
