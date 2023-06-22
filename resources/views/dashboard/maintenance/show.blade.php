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
                    href="/dashboard/maintenance/{{ $data->slug }}/edit"
                    class="btn-warning"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Edit maintenance"
                    ><i class="bi bi-pencil-square"></i> Edit maintenance
                </x-button-link>

                <form
                    action="/dashboard/maintenance/{{ $data->slug }}"
                    method="post"
                    class="d-inline"
                >
                    @method('delete') @csrf
                    <button
                        class="btn btn-danger border-0 rounded-0"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Delete data"
                        onclick="return confirm('are You sure ??')"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>
            </x-button-group>
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
                                    data-bs-target="#sparepart"
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
                                            {{ $data->description }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Instruction
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->instruction }}
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
                            ></div>

                            <div
                                class="tab-pane fade documents pt-3"
                                id="documents"
                            >
                                Document
                            </div>
                            <div
                                class="tab-pane fade progres pt-3"
                                id="progres"
                            >
                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: 25%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    >
                                        25%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-card-body>
                </x-card2>
            </div>
        </div>
    </x-section>
</x-dashboard>
