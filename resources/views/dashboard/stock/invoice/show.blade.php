<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/invoiceStock"
                name="Invoice"
            />
            <x-breadcrumb-item link="" name="{{ $data->name }}" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:stok.invoice.stock-data :invoiceId="$data->id" />

    <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->

    @push('jslivewire') @livewireScripts

    <script>
        window.addEventListener("close-modal", (event) => {
            $("#stockModal").modal("hide");
            $("#updateStockModal").modal("hide");
            $("#deleteStockModal").modal("hide");
        });
    </script>

    @endpush
</x-dashboard>
