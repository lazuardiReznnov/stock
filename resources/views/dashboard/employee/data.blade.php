<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/employee" name="Employee" />
            <x-breadcrumb-item link="" name="{{ $data->name }}" />
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
</x-dashboard>
