<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Sparepart" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:stok.sparepart.index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#sparepartStockModal").modal("hide");
            $("#updateSparepartStockModal").modal("hide");
            $("#deleteSparepartStockModal").modal("hide");
        });
    </script>
    @endpush
</x-dashboard>
