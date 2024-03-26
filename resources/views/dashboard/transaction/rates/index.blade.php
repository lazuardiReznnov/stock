<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/transaction"
                name="transaction"
            />

            <x-breadcrumb-item link="" name="{{ $title }}" />
        </x-breadcrumb>
    </x-pagetitle>

    <section class="section dashboard">
        <div class="row">
            <div class="col-md">
                <x-card-title> Select Customer </x-card-title>
            </div>
            <div class="col-md">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="/dashboard/transaction/rate/region"
                            >Regions</a
                        >
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->

                    <!-- End Sales Card -->
                    <!-- Sales Card -->
                    @foreach($datas as $data)
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span>{{ $data->name }}</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    >
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6></h6>

                                        <span
                                            class="text-muted small pt-2 ps-1"
                                        >
                                            <a
                                                href="/dashboard/transaction/rate/customer/{{ $data->slug }}"
                                                class="fw-bold"
                                                >Detail</a
                                            >
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- End Sales Card -->
                </div>
            </div>
        </div>
    </section>
</x-dashboard>
