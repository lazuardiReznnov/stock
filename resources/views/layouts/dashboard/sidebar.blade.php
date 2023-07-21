<x-sidebar-nav>
    <x-nav-item>
        <x-nav-link href="/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </x-nav-link>
    </x-nav-item>

    <x-nav-item>
        <x-nav-link
            href="#"
            data-bs-target="#user-nav"
            data-bs-toggle="collapse"
        >
            <i class="bi bi-person-badge"></i><span>User Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="user-nav">
            <x-nav-content-item link="/dashboard/user">
                User List
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>

    <x-nav-item>
        <x-nav-link
            href="#"
            data-bs-target="#stock-nav"
            data-bs-toggle="collapse"
        >
            <i class="bi bi-box"></i><span>stock Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="stock-nav">
            <x-nav-content-item link="/dashboard/stock">
                Stock
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>

    <x-nav-item>
        <x-nav-link
            href="#"
            data-bs-target="#unit-nav"
            data-bs-toggle="collapse"
        >
            <i class="bi bi-truck-front"></i><span>unit Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="unit-nav">
            <x-nav-content-item link="/dashboard/unit">
                Unit List
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>

    <x-nav-item>
        <x-nav-link
            href="#"
            data-bs-target="#maintenance-nav"
            data-bs-toggle="collapse"
        >
            <i class="bi bi-tools"></i><span>maintenance Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="maintenance-nav">
            <x-nav-content-item link="/dashboard/maintenance">
                Maintenance Unit Data
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>
    <x-nav-item>
        <x-nav-link
            href="#"
            data-bs-target="#report-nav"
            data-bs-toggle="collapse"
        >
            <i class="bi bi-file"></i><span>report Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="report-nav">
            <x-nav-content-item link="/dashboard/report">
                report Data
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>
</x-sidebar-nav>
