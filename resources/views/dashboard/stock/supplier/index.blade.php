<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item link="" name="Supplier" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:stok.supplier.index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#supplierModal").modal("hide");
            $("#updateSupplierModal").modal("hide");
            $("#deleteSupplierModal").modal("hide");
        });
    </script>
    @endpush
</x-dashboard>
