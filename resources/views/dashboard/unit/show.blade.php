<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item link="" name="{{ $title }}" />
        </x-breadcrumb>
    </x-pagetitle>
    <div class="row my-4">
        <div class="col-md-6">
            <x-button-group>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/unit"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Back"
                >
                    Back
                </x-button-link>

                <x-button-link
                    href="/dashboard/unit/{{ $data->slug }}/edit"
                    class="btn-warning"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Edit unit"
                    ><i class="bi bi-pencil-square"></i> Edit Unit
                </x-button-link>

                <form
                    action="/dashboard/unit/{{ $data->slug }}"
                    method="post"
                    class="d-inline"
                >
                    @method('delete') @csrf
                    <button
                        class="btn btn-danger border-0 rounded-0"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Delete Suppler"
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
                        @if($data->image)
                        <img
                            width="200"
                            class="rounded-circle"
                            alt=""
                            src="{{ asset('storage/'. $data->image->pic) }}"
                        />
                        @else

                        <img
                            class="rounded-circle mx-auto d-block shadow my-3"
                            src="http://source.unsplash.com/200x200?smartphones"
                            alt=""
                        />
                        @endif
                        <h2>{{ $data->name }}</h2>
                    </x-card-body>
                </x-card2>
            </div>
            <div class="col-xl-8" wire:ignore.self>
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
                                    data-bs-target="#letter"
                                >
                                    Letter
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                    class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#repair"
                                >
                                    Repair History
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div
                                class="tab-pane fade show active profile-overview"
                                id="profile-overview"
                            >
                                <!-- Spesification -->
                                <x-card-title>About</x-card-title>
                                <p class="small fst-italic">
                                    {!! $data->description !!}
                                </p>
                                <x-card-title> Spesification </x-card-title>
                                <div class="profile-overview">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            No. Registration
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Merk/Type
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->type->brand->name }}
                                            {{ $data->type->name }}
                                        </div>
                                    </div>
                                    <!-- spesification -->
                                    <livewire:unit.spec-update
                                        :unitId="$data->id"
                                    />
                                    <!-- endSpesification -->
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Last Update
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $data->updated_at->diffforhumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade letter pt-3" id="letter">
                                <!-- vrc -->
                                <livewire:unit.vrc-update :unitId="$data->id" />
                                <!-- endVrc -->
                                <livewire:unit.vipc-update
                                    :unitId="$data->id"
                                />
                            </div>
                            <div class="tab-pane fade repair pt-3" id="repair">
                                <livewire:unit.unit-maintenance
                                    :unitId="$data->id"
                                />
                            </div>
                        </div>
                    </x-card-body>
                </x-card2>
            </div>
        </div>
    </x-section>
    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#updateVrcModal").modal("hide");
            $("#showImageModal").modal("hide");
            $("#showImageVpicModal").modal("hide");
            $("#updateVipcModal").modal("hide");
            $("#updateSpecModal").modal("hide");
        });
    </script>

    @endpush
</x-dashboard>
