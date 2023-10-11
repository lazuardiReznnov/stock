<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Employee" />
        </x-breadcrumb>
    </x-pagetitle>
    <section class="section dashboard">
        <h3 class="card-title">Select Division</h3>
        <div class="row">
            @foreach($datas as $d)
            <div class="col-md">
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
                                        href="/dashboard/employee/{{
                                            $d->slug
                                        }}"
                                        >Detail</a
                                    ></span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-dashboard>
