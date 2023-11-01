<x-dashboard title="{{ $title }}">
    @push('csslivewire') @livewireStyles @endpush
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/employee" name="Employee" />
            <x-breadcrumb-item link="" name="{{ $data->name }}" />
        </x-breadcrumb>
    </x-pagetitle>
    <!-- link -->

    <livewire:employee.index :divisionId="$data->id" />

    @push('jslivewire') @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        window.addEventListener("close-modal", (event) => {
            $("#employeeModal").modal("hide");
            $("#updateEmployeeModal").modal("hide");
            $("#deleteEmployeeModal").modal("hide");
        });
    </script>
    @endpush
</x-dashboard>
