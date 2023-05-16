<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Supplier" />
        </x-breadcrumb>
    </x-pagetitle>

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
                        @endif
                        <h2>{{ $data->name }}</h2>
                    </x-card-body>
                </x-card2>
            </div>
            <div class="col-xl-8">
                <x-card2>
                    <x-card-body class="pt-2">
                        <x-card-title> About </x-card-title>
                        <div class="profile-overview">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Full Name
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $data->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $data->phone }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $data->email }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">
                                    Address
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $data->address }}
                                </div>
                            </div>
                        </div>
                    </x-card-body>
                </x-card2>
            </div>
        </div>
    </x-section>
</x-dashboard>
