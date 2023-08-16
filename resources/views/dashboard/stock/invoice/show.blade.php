<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />
    @endpush
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".js-example-basic-multiple").select2({ placeholder: "Tags" });
            $('#select2').on('change', function (e) {
                var data = $('#select2').select2("val");
                 @this.set('selected', data);
            });
        });
    </script>
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
