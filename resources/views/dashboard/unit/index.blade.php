<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Unit" />
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
                        href="/dashboard/unit/brand"
                        >brand</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/Unit"
                        >Type Unit</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/categoryUnit"
                        >Category Unit</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/letter">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/group">Group</a>
                </li>
            </ul>
        </div>
        <!-- endlink -->
    </div>

    <livewire:unit.unit-index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#unitModal").modal("hide");
            $("#updateUnitModal").modal("hide");
            $("#deleteUnitModal").modal("hide");
        });
    </script>

    @endpush
</x-dashboard>
