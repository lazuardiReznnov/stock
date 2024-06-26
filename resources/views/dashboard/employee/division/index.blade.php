<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/employee" name="employee" />
            <x-breadcrumb-item link="" name="Division" />
        </x-breadcrumb>
    </x-pagetitle>

    <livewire:employee.division.index />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#divisionModal").modal("hide");
            $("#updateDivisionModal").modal("hide");
            $("#deleteDivisionModal").modal("hide");
        });
    </script>
    @endpush</x-dashboard
>
