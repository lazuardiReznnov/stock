<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Employee" />
        </x-breadcrumb>
    </x-pagetitle>
    <!-- link -->
    <div class="row">
        <!-- link -->
        <div class="col-md-6 ms-auto">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        aria-current="page"
                        href="/dashboard/employee/division"
                        >Division</a
                    >
                </li>
            </ul>
        </div>
        <!-- endlink -->
    </div>

    <section class="section dashboard">
        <div class="row">
            @foreach($datas as $d)
            <div class="col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $d->name }}
                        </h5>

                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                            >
                                <i class="bi bi-bank"></i>
                            </div>

                            <div class="ps-3">
                                <h6>{{ $d->description }}</h6>
                                <span class="text-success small pt-1 fw-bold"
                                    ><a
                                        href="/dashboard/employee/data/{{
                                        $d->slug
                                    }}"
                                        >Data</a
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-dashboard>
