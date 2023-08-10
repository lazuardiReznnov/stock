<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item link="" name="Brand" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:unit.brand-index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#brandModal").modal("hide");
            $("#updateBrandModal").modal("hide");
            $("#deleteBrandModal").modal("hide");
        });
    </script>

    @endpush
</x-dashboard>
