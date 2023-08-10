<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Maintenance" />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            @if(session()->has('success'))

            <!-- pesan -->

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session("success") }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="close"
                ></button>
            </div>

            <!-- endpesan -->

            @endif
        </div>
    </div>

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
        });
    </script>
    @endpush
</x-dashboard>
