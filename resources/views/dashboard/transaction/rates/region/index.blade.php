<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item
                link="/dashboard/transaction"
                name="Transaction"
            />
            <x-breadcrumb-item
                link="/dashboard/transaction/rate"
                name="Rates"
            />
            <x-breadcrumb-item link="" name="Regions" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:transaction.rate.region.index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#regionModal").modal("hide");
            $("#updateRegionModal").modal("hide");
            $("#deleteRegionModal").modal("hide");
        });
    </script>
    @endpush
</x-dashboard>
