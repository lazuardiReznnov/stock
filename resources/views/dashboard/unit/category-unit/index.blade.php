<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/unit" name="Unit" />
            <x-breadcrumb-item link="" name="Category Unit" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:unit.category-unit-index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#categoryUnitModal").modal("hide");
            $("#updateCategoryUnitModal").modal("hide");
            $("#deleteCategoryUnitModal").modal("hide");
        });
    </script>

    @endpush
</x-dashboard>
