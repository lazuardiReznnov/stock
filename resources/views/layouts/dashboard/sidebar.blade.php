<x-sidebar-nav>
    <x-nav-item>
        <x-nav-link href="/home">
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
            <i class="bi bi-menu-button-wide"></i><span>User Management</span
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
            <i class="bi bi-menu-button-wide"></i><span>stock Management</span
            ><i class="bi bi-chevron-down ms-auto"></i>
        </x-nav-link>
        <x-nav-content id="stock-nav">
            <x-nav-content-item link="/dashboard/stock">
                Stock
            </x-nav-content-item>
        </x-nav-content>
    </x-nav-item>
</x-sidebar-nav>
