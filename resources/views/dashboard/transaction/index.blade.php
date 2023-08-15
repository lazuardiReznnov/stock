<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />

            <x-breadcrumb-item link="" name="{{ $title }}" />
        </x-breadcrumb>
    </x-pagetitle>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a
                                    class="icon"
                                    href="#"
                                    data-bs-toggle="dropdown"
                                    ><i class="bi bi-three-dots"></i
                                ></a>
                                <ul
                                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                                >
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Today</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >This Month</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >This Year</a
                                        >
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Sales <span>| Today</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    >
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span
                                            class="text-success small pt-1 fw-bold"
                                            >12%</span
                                        >
                                        <span class="text-muted small pt-2 ps-1"
                                            >increase</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Customer <span>| Total</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                    >
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>

                                        <span
                                            class="text-muted small pt-2 ps-1"
                                        >
                                            <a
                                                href="/dashboard/transaction/customer"
                                                class="fw-bold"
                                                >Detail</a
                                            >
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->
                </div>
            </div>
        </div>
    </section>
</x-dashboard>