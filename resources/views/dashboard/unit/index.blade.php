<x-dashboard title="{{ $title }}">
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="" name="Unit" />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-4">
            <x-button-group>
                <x-button-link class="btn-primary" href="/dashboard">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </x-button-link>
                <x-button-link
                    class="btn-primary"
                    href="/dashboard/stock/invoiceStock"
                >
                    <i class="bi bi-plus-circle"></i> Stock-In
                </x-button-link>
            </x-button-group>
        </div>
        <div class="col-md-6">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        aria-current="page"
                        href="/dashboard/unit/brand"
                        >brand</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/type"
                        >Type Unit</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/categoryUnit"
                        >Category Unit</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/unit/letter">Report</a>
                </li>
            </ul>
        </div>
    </div>
</x-dashboard>
