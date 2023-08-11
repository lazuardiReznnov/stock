<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Maintenance" />
        </x-breadcrumb>
    </x-pagetitle>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-6 col-md-6">
                        <livewire:maintenance.card-count />
                    </div>
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-6 col-md-6">
                        <livewire:maintenance.card-count-part />
                    </div>
                    <!-- End Revenue Card -->
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <livewire:maintenance.index />
        </div>
    </div>

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#maintenanceModal").modal("hide");
            $("#updateMaintenanceModal").modal("hide");
            $("#deleteMaintenanceModal").modal("hide");
        });
    </script>
    @endpush
</x-dashboard>
