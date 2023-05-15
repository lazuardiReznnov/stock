<x-dashboard>
    <x-pagetitle title="{{ $title }}">
        <x-breadcrumb>
            <x-breadcrumb-item link="/dashboard" name="Dashboard" />
            <x-breadcrumb-item link="/dashboard/stock" name="Stock" />
            <x-breadcrumb-item
                link="/dashboard/stock/supplier"
                name="Supplier"
            />
            <x-breadcrumb-item link="" name="Form " />
        </x-breadcrumb>
    </x-pagetitle>

    <div class="row">
        <div class="col-md-8">
            <x-card>
                <x-card-title> Form Supplier </x-card-title>
            </x-card>
        </div>
    </div>
</x-dashboard>
